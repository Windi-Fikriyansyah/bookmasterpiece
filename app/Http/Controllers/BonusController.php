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
        $bonus = DB::table('bonuses')->where('slug', $slug)->firstOrFail();

        // full URL PDF dari aplikasi lain
        $pdfUrl = 'https://sekolahliterasi.com/storage/' . $bonus->file_path;

        return view('bonus.view', compact('bonus', 'pdfUrl'));
    }
}
