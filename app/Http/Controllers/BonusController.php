<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class BonusController extends Controller
{
    public function index()
    {
        // ambil semua bonus dari database
        $bonuses = DB::table('bonuses')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('bonus.index', compact('bonuses'));
    }

    public function view($slug)
    {
        $bonus = DB::table('bonuses')->where('slug', $slug)->first();
        abort_if(! $bonus, 404);

        return redirect()->away(
            'https://sekolahliterasi.com/storage/' . $bonus->file_path
        );
    }
}
