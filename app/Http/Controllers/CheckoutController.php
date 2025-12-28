<?php

namespace App\Http\Controllers;

use App\Services\TripayService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{
    public function index($slug)
    {
        $package = DB::table('subscription_packages')
            ->where('slug', $slug)
            ->first();

        abort_if(!$package, 404);

        return view('checkout.index', compact('package'));
    }

    public function renew($slug)
    {
        $user = Auth::user();

        $package = DB::table('subscription_packages')
            ->where('slug', $slug)
            ->first();

        abort_if(! $package, 404);

        // ✅ BUAT ORDER TANPA ISI DATA LAGI
        $orderId = DB::table('orders_langganan')->insertGetId([
            'name'       => $user->name,
            'email'      => $user->email,
            'phone'      => $user->no_hp,
            'package_id' => $package->id,
            'status'     => 'UNPAID',
            'created_at' => now(),
        ]);

        $merchantRef = 'ORDER-' . $orderId;

        DB::table('orders_langganan')
            ->where('id', $orderId)
            ->update([
                'merchant_ref' => $merchantRef
            ]);

        // 🔥 LANGSUNG KE METODE PEMBAYARAN
        $channels = TripayService::getPaymentChannels($package->price);

        return view('checkout.payment-method', compact(
            'channels',
            'orderId',
            'package'
        ));
    }
    // STEP 1: simpan data & tampilkan metode pembayaran
    public function process(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        $existingUser = DB::table('users')
            ->where('email', $request->email)
            ->orWhere('no_hp', $request->phone)
            ->first();

        if ($existingUser) {
            return back()->with('error', 'Email atau No WhatsApp sudah terdaftar');
        }

        $password = Str::random(8);

        $orderId = DB::table('orders_langganan')->insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'package_id' => $request->package_id,
            'password_plain' => $password,
            'status' => 'UNPAID',
            'created_at' => now(),
        ]);

        $merchantRef = 'ORDER-' . $orderId;

        DB::table('orders_langganan')
            ->where('id', $orderId)
            ->update([
                'merchant_ref' => $merchantRef
            ]);
        $package = DB::table('subscription_packages')->find($request->package_id);

        // ambil channel pembayaran
        $channels = TripayService::getPaymentChannels($package->price);

        return view('checkout.payment-method', compact(
            'channels',
            'orderId',
            'package'
        ));
    }

    // STEP 2: user pilih metode
    public function pay(Request $request)
    {
        $order = DB::table('orders_langganan')->find($request->order_id);
        $package = DB::table('subscription_packages')->find($order->package_id);

        $tripay = TripayService::createInvoice([
            'merchant_ref'   => $order->merchant_ref,
            'order_id' => $order->id,
            'amount' => $package->price,
            'method' => $request->method,
            'customer_name' => $order->name,
            'customer_email' => $order->email,
            'customer_phone' => $order->phone,
        ]);

        DB::table('orders_langganan')
            ->where('id', $order->id)
            ->update([
                'tripay_reference' => $tripay['reference'],
                'payment_method' => $request->method,
            ]);

        return redirect($tripay['checkout_url']);
    }
}
