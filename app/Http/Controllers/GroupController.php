<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function index()
    {
        $subscription = DB::table('user_subscriptions')
            ->join('subscription_packages', 'subscription_packages.id', '=', 'user_subscriptions.package_id')
            ->where('user_subscriptions.user_id', Auth::id())
            ->where('user_subscriptions.status', 'active')
            ->where(function ($q) {
                $q->whereNull('user_subscriptions.expired_at')
                    ->orWhere('user_subscriptions.expired_at', '>', now());
            })
            ->select(
                'subscription_packages.duration'
            )
            ->first();

        if (! $subscription) {
            return redirect()->route('langganan')
                ->with('error', 'Langganan Anda tidak aktif.');
        }

        return view('group.index', compact('subscription'));
    }
}
