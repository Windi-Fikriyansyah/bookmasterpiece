<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckSubscription
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login');
        }

        /**
         * 1️⃣ UPDATE otomatis subscription yang sudah expired
         *    (kecuali expired_at = NULL)
         */
        DB::table('user_subscriptions')
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->whereNotNull('expired_at')
            ->where('expired_at', '<=', now())
            ->update([
                'status' => 'expired',
                'updated_at' => now(),
            ]);

        /**
         * 2️⃣ CEK subscription aktif yang masih valid
         */
        $subscription = DB::table('user_subscriptions')
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->where(function ($q) {
                $q->whereNull('expired_at') // lifetime
                    ->orWhere('expired_at', '>', now());
            })
            ->first();

        /**
         * 3️⃣ Jika tidak ada → tendang dari halaman berbayar
         *    TANPA logout
         */
        if (! $subscription) {
            return redirect()->route('ebook_master')
                ->with('error', 'Langganan Anda telah berakhir.');
        }

        return $next($request);
    }
}
