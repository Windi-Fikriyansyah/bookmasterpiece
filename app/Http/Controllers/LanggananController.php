<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class LanggananController extends Controller
{
    public function index()
    {
        $packages = DB::table('subscription_packages')
            ->orderBy('sort_order')          // 🔥 urutan utama
            ->orderByDesc('is_featured')     // featured tetap bisa prioritas visual
            ->get()
            ->map(function ($package) {
                $package->features = DB::table('subscription_features')
                    ->where('subscription_package_id', $package->id)
                    ->get();
                return $package;
            });

        return view('langganan.index', compact('packages'));
    }
}
