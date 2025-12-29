<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\FonnteService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;


class TripayCallbackController extends Controller
{
    protected $privateKey;

    public function __construct()
    {
        $this->privateKey = config('services.tripay.private_key');
    }

    public function handle(Request $request)
    {
        Log::channel('daily')->info('TRIPAY CALLBACK RAW', [
            'headers' => $request->headers->all(),
            'body'    => $request->getContent(),
        ]);

        $callbackSignature = (string) $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $callbackEvent     = (string) $request->server('HTTP_X_CALLBACK_EVENT');
        $json = $request->getContent();

        // 1️⃣ VALIDASI SIGNATURE
        if (hash_hmac('sha256', $json, config('services.tripay.private_key')) !== $callbackSignature) {
            return response()->json(['success' => false], 403);
        }

        // 2️⃣ VALIDASI EVENT
        if ($callbackEvent !== 'payment_status') {
            return response()->json(['success' => false], 400);
        }

        // 3️⃣ DECODE JSON
        $data = json_decode($json);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['success' => false], 400);
        }

        // 🔥🔥🔥
        // 4️⃣ RESPONSE KE TRIPAY (WAJIB CEPAT)
        $response = response()->json(['success' => true]);

        // 5️⃣ PROSES DATABASE DI BELAKANG
        dispatch(function () use ($data) {

            Log::channel('daily')->info('TRIPAY CALLBACK FIELDS', [
                'status' => $data->status ?? null,
                'reference' => $data->reference ?? null,
                'merchant_ref' => $data->merchant_ref ?? null,
                'is_closed_payment' => $data->is_closed_payment ?? 'NOT SENT',
            ]);
            if ($data->is_closed_payment != 1) return;

            $order = DB::table('orders_langganan')
                ->where('merchant_ref', $data->merchant_ref)
                ->where('tripay_reference', $data->reference)
                ->first();

            if (! $order || $order->status === 'PAID') return;

            DB::table('orders_langganan')->where('id', $order->id)->update([
                'status' => 'PAID',
                'paid_at' => now(),
            ]);

            $package = DB::table('subscription_packages')->find($order->package_id);

            // 🔍 cek user existing
            $user = DB::table('users')->where('email', $order->email)->first();

            if (! $user) {
                // ✅ USER BARU
                $userId = DB::table('users')->insertGetId([
                    'name' => $order->name,
                    'email' => $order->email,
                    'no_hp' => $order->phone,
                    'password' => bcrypt($order->password_plain),
                    'is_active' => 1,
                    'created_at' => now(),
                ]);

                // kirim WA hanya untuk user baru
                FonnteService::sendWA(
                    $order->phone,
                    app(\App\Http\Controllers\TripayCallbackController::class)->waMessage($order)
                );
            } else {
                // 🔁 USER LAMA (PERPANJANG)
                $userId = $user->id;
            }

            // 🧠 hitung masa aktif
            $now = now();

            if ($package->duration === 'lifetime') {
                $expiredAt = null;
            } else {
                $lastSub = DB::table('user_subscriptions')
                    ->where('user_id', $userId)
                    ->where('status', 'active')
                    ->orderByDesc('expired_at')
                    ->first();
                $start = $lastSub && $lastSub->expired_at
                    ? \Carbon\Carbon::parse($lastSub->expired_at)
                    : now();
                if ($start->lessThan(now())) {
                    $start = now();
                }

                $expiredAt = $package->duration === 'bulan'
                    ? $start->copy()->addMonths($package->duration_value)
                    : $start->copy()->addYears($package->duration_value);
            }

            // 🔍 ambil subscription terakhir (active / expired)
            $subscription = DB::table('user_subscriptions')
                ->where('user_id', $userId)
                ->orderByDesc('expired_at')
                ->first();

            if ($subscription) {

                // 🧠 HITUNG START BARU
                $start = $subscription->expired_at && \Carbon\Carbon::parse($subscription->expired_at)->gt(now())
                    ? \Carbon\Carbon::parse($subscription->expired_at)
                    : now();

                // 🧠 HITUNG EXPIRED BARU
                if ($package->duration === 'lifetime') {
                    $expiredAt = null;
                } else {
                    $expiredAt = $package->duration === 'bulan'
                        ? $start->copy()->addMonths($package->duration_value)
                        : $start->copy()->addYears($package->duration_value);
                }

                // ✅ UPDATE DATA YANG ADA
                DB::table('user_subscriptions')
                    ->where('id', $subscription->id)
                    ->update([
                        'package_id' => $package->id,
                        'started_at' => now(),
                        'expired_at' => $expiredAt,
                        'status' => 'active',
                        'updated_at' => now(),
                    ]);
            } else {

                // 🆕 USER PERTAMA KALI LANGGANAN
                DB::table('user_subscriptions')->insert([
                    'user_id' => $userId,
                    'package_id' => $package->id,
                    'started_at' => now(),
                    'expired_at' => $expiredAt,
                    'status' => 'active',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        })->afterResponse();


        return $response;
    }


    public function success(Request $request)
    {
        $order = DB::table('orders_langganan')
            ->where('merchant_ref', $request->ref)
            ->first();

        // if (! $order || $order->status !== 'PAID') {
        //     return view('payment.pending');
        // }

        return view('payment.success');
    }


    private function waMessage($order)
    {
        return
            "Halo {$order->name},

✅ Pembayaran BERHASIL
Terima kasih telah berlangganan *Book Masterpiece AI*.

📧 Email Login:
{$order->email}

🔐 Password:
{$order->password_plain}

👉 Login:
https://bookmasterpiece.sekolahliterasi.com/login

🎁 BONUS EKSKLUSIF:
• Akses Cover Masterpiece
• Formula Book Pensera
• Prompt AI Siap Pakai
• Template Outline Buku
• Video Step-by-Step
• Grup WhatsApp Eksklusif

Salam Literasi ✍️
Tim Book Masterpiece AI";
    }
}
