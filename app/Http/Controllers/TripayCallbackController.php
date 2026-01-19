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

            $status = strtoupper($data->status ?? '');

            Log::channel('daily')->info('TRIPAY CALLBACK PROCESSED', [
                'merchant_ref' => $data->merchant_ref,
                'reference' => $data->reference,
                'status' => $status,
            ]);

            $order = DB::table('orders_langganan')
                ->where('merchant_ref', $data->merchant_ref)
                ->where('tripay_reference', $data->reference)
                ->first();

            if (! $order) return;

            // 🔒 JIKA BUKAN PAID → UPDATE STATUS SAJA, STOP
            if ($status !== 'PAID') {
                DB::table('orders_langganan')
                    ->where('id', $order->id)
                    ->update([
                        'status' => $status,
                        'updated_at' => now(),
                    ]);
                return;
            }

            // 🛑 DOUBLE PROTECTION
            if ($order->status === 'PAID') return;

            // ✅ VALID PAID
            DB::table('orders_langganan')->where('id', $order->id)->update([
                'status' => 'PAID',
                'paid_at' => now(),
                'updated_at' => now(),
            ]);

            $package = DB::table('subscription_packages')->find($order->package_id);

            // 🔍 cek user
            $user = DB::table('users')->where('email', $order->email)->first();

            if (! $user) {
                $userId = DB::table('users')->insertGetId([
                    'name' => $order->name,
                    'email' => $order->email,
                    'no_hp' => $order->phone,
                    'password' => bcrypt($order->password_plain),
                    'is_active' => 1,
                    'created_at' => now(),
                ]);

                // ✅ WA HANYA UNTUK PAID
                FonnteService::sendWA(
                    $order->phone,
                    app(self::class)->waMessage($order, $package)
                );
            } else {
                $userId = $user->id;
            }

            // 🧠 Subscription logic (aman)
            $start = now();
            $expiredAt = null;

            if ($package->duration !== 'lifetime') {
                $expiredAt = $package->duration === 'bulan'
                    ? now()->addMonths($package->duration_value)
                    : now()->addYears($package->duration_value);
            }

            DB::table('user_subscriptions')->updateOrInsert(
                ['user_id' => $userId],
                [
                    'package_id' => $package->id,
                    'started_at' => now(),
                    'expired_at' => $expiredAt,
                    'status' => 'active',
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
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


    private function waMessage($order, $package)
    {
        $bonusMessage = '';

        // Normalisasi nama paket (aman)
        $packageName = strtolower($package->duration ?? $package->slug ?? '');

        if (str_contains($packageName, 'premium')) {
            $bonusMessage = <<<TXT
🎁 *BONUS PAKET PREMIUM*:
- Bonus aplikasi Book Cover Masterpiece (desain cover instan)
- Bonus aplikasi Book Image Masterpiece (visual & ilustrasi buku)
- Bonus aplikasi Storybook Masterpiece (buku cerita lengkap + ilustrasi)
- Hemat hingga 15% (jauh lebih ekonomis dibanding paket berlangganan)
- Prioritas update fitur terbaru
- Priority support (dibantu lebih cepat)
- Template buku siap terbit
- Prompt AI & Formula Pensera siap pakai
- Prompt AI Editor, Parafrase & Verifikator
- Video tutorial Book Masterpiece (step-by-step)
- Akses grup premium (WhatsApp)
TXT;
        } else {
            // Default → Standar
            $bonusMessage = <<<TXT
🎁 *BONUS PAKET STANDAR*:
- Template Buku Siap Terbit
- Promt AI dan Formula Pensera Siap Pakai
- Promt AI Editor, Parafase dan Verifikator
- Video Tutorial Book Masterpiece
- Grup WhatsApp Eksklusif
TXT;
        }

        return <<<MSG
Halo {$order->name},

✅ *Pembayaran BERHASIL*
Terima kasih telah berlangganan *Book Masterpiece AI*.

📧 Email Login:
{$order->email}

🔐 Password:
{$order->password_plain}

👉 Login:
https://bookmasterpiece.sekolahliterasi.com/login

{$bonusMessage}

Salam Literasi ✍️
Tim *Book Masterpiece AI*
MSG;
    }
}
