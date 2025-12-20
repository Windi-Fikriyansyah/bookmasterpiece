<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use PDF;

class AksesAplikasiController extends Controller
{
    public function aksesAplikasi()
    {
        return view('akses_aplikasi');
    }

    public function bookMasterpiece()
    {
        return view('akses_aplikasi.bookMasterpiece');
    }

    public function getApiKey()
    {
        $user = DB::table('users')->where('id', auth()->id())->first();

        return response()->json([
            'api_key' => $user->api_key ?? ''
        ]);
    }

    public function saveApiKey(Request $request)
    {
        $request->validate([
            'api_key' => 'required'
        ]);

        $apiKey = $request->api_key;

        $check = Http::get("https://generativelanguage.googleapis.com/v1/models?key=" . $apiKey);

        if ($check->failed()) {
            return response()->json([
                'status' => false,
                'message' => 'API Key tidak valid! Periksa kembali API key Anda.'
            ], 400);
        }

        DB::table('users')
            ->where('id', auth()->id())
            ->update([
                'api_key' => $apiKey,
                'updated_at' => now()
            ]);

        return response()->json([
            'status' => true,
            'message' => 'API Key valid & berhasil disimpan!'
        ]);
    }

    public function generateEbookPart(Request $request)
    {
        $request->validate([
            'action' => 'required|in:title,intro,outline,chapter,summary,closing',
            'masalah' => 'required|string',
            'kebutuhan' => 'nullable|string',
            'solusi' => 'nullable|string',
            'pengalaman' => 'nullable|string',
            'kompetensi' => 'nullable|string',
            'calon_pembaca' => 'nullable|string',
            'pengantar_penulis' => 'nullable|string',
            'tentang_penulis' => 'nullable|string',
            'gaya' => 'required|string',
            'jumlah_outline' => 'nullable|string', // "5 Bab 5 Sub Bab"
            'existing_title' => 'nullable|string',
            'current_chapter_count' => 'nullable|integer|min:0',
            'chapter_titles' => 'nullable|array',
            'target_chapter' => 'nullable|integer|min:1',
            'chapter_title_from_toc' => 'nullable|string', // ✅ Tambahkan ini
            'sub_bab_titles' => 'nullable|array',
        ]);

        $user = DB::table('users')->where('id', auth()->id())->first();

        if (!$user || !$user->api_key) {
            return response()->json([
                'status'  => false,
                'message' => 'API Key belum disimpan. Silakan isi dulu API Key Google AI Anda.',
            ], 400);
        }

        $apiKey     = $user->api_key;
        $masalah    = $request->masalah;
        $kebutuhan = $request->kebutuhan ?? '';
        $solusi = $request->solusi ?? '';
        $pengalaman = $request->pengalaman ?? '';
        $kompetensi = $request->kompetensi ?? '';
        $calonPembaca = $request->calon_pembaca ?? '';
        $pengantarPenulis = $request->pengantar_penulis ?? '';
        $tentangPenulis = $request->tentang_penulis ?? '';
        $jumlahOutlineRaw = $request->jumlah_outline ?? '';
        [$totalBab, $subBabPerBab] = $this->parseOutlineSpec($jumlahOutlineRaw);
        $gaya       = $request->gaya;
        // $jumlahBab  = $request->jumlah_bab ?? 3;
        // $penulis    = $request->penulis ?? '';
        $action     = $request->action;
        $existingTitle = $request->existing_title;
        $currentChapterCount = $request->current_chapter_count ?? 0;
        $chapterTitles = $request->chapter_titles ?? [];
        $targetChapter = $request->target_chapter ?? ($currentChapterCount + 1);

        $chapterTitleFromTOC = $request->chapter_title_from_toc ?? '';
        $subBabTitles = $request->sub_bab_titles ?? [];

        // Base prompt dengan instruksi format yang lebih baik
        $basePrompt =
            "Kamu adalah asisten penulis buku profesional berbahasa Indonesia.\n" .
            "Tugasmu menulis konten buku yang sangat sesuai dengan data pengguna.\n\n" .
            "ATURAN FORMAT OUTPUT:\n" .
            "- Output WAJIB berupa HTML bersih (tanpa atribut): hanya h1,h2,h3,p,ul,ol,li,blockquote\n" .
            "- Jangan gunakan div/span/style/class/id/atribut apapun.\n" .
            "- Jangan menulis pembuka seperti 'Berikut ini...' yang terlalu AI, langsung masuk gaya buku.\n\n" .
            "KONTEKS BUKU (WAJIB DIJADIKAN DASAR):\n" .
            "1) Masalah utama pembaca:\n{$masalah}\n\n" .
            "2) Kebutuhan (Need) pembaca:\n{$kebutuhan}\n\n" .
            "3) Solusi (Solution) yang ditawarkan buku:\n{$solusi}\n\n" .
            "4) Pengalaman relevan penulis (Experience):\n{$pengalaman}\n\n" .  // ✅ TAMBAH
            "5) Kompetensi penulis (Competence):\n{$kompetensi}\n\n" .
            "6) Calon pembaca utama (persona target):\n{$calonPembaca}\n\n" .
            "7) Gaya bahasa yang harus dipakai: {$gaya}\n" .
            "8) Target struktur outline: {$totalBab} Bab, tiap Bab ± {$subBabPerBab} Sub-bab (h3).\n\n";

        if (!empty($existingTitle) && $action !== 'title') {
            $basePrompt .= "Judul buku yang sudah ada:\n" . strip_tags($existingTitle) . "\n\n";
        }

        if (!empty($pengantarPenulis)) {
            $basePrompt .= "Pengantar Penulis (dipakai untuk bagian 'Pengantar Penulis'):\n{$pengantarPenulis}\n\n";
        }

        if (!empty($tentangPenulis)) {
            $basePrompt .= "Tentang Penulis (dipakai untuk bagian 'Tentang Penulis'):\n{$tentangPenulis}\n\n";
        }

        $chapterNumber = $currentChapterCount + 1;

        $chapterTitle = '';
        $subBabTitles = $request->sub_bab_titles ?? [];

        if (isset($chapterTitles[$targetChapter - 1])) {
            $chapterTitle = strip_tags($chapterTitles[$targetChapter - 1]);
            $basePrompt .= "JUDUL BAB YANG DIUTAMAKAN: {$chapterTitle}\n\n";
        }

        // TAMBAHKAN PROMPT UNTUK SUB-BAB
        if (!empty($subBabTitles)) {
            $basePrompt .= "STRUKTUR SUB-BAB YANG HARUS DIIKUTI:\n";
            foreach ($subBabTitles as $index => $subBab) {
                $subBabNumber = $subBab['number'] ?? ($index + 1);
                $subBabTitle = $subBab['title'] ?? '';
                $basePrompt .= "{$subBabNumber}: {$subBabTitle}\n";
            }
            $basePrompt .= "\nHARUS mengikuti urutan sub-bab di atas dengan tepat!\n\n";
        }

        switch ($action) {
            case 'title':
                $instruction = "
BUATKAN HANYA JUDUL EBOOK (JANGAN BUAT SUBJUDUL ATAU KONTEN LAIN):

Format yang HARUS digunakan:
<h1>Judul Utama Ebook</h1>

Contoh format yang benar:
<h1>Mastering Productivity: Seni Menyelesaikan Pekerjaan</h1>

JANGAN TAMBAHKAN SUBJUDUL, PARAGRAF, ATAU KONTEN LAINNYA.
HANYA SATU TAG <h1> SAJA.

Judul harus:
1. Relevan dengan masalah: {$masalah}
2. Menggunakan gaya bahasa: {$gaya}
3. Cukup panjang (4-8 kata)
4. Menarik perhatian pembaca
5. BERFOKUS PADA MASALAH DAN SOLUSI
";
                break;


            case 'intro':
                $instruction =
                    "BUATKAN BAGIAN AWAL BUKU (PENDAHULUAN SAJA):\n" .
                    "Format WAJIB:\n" .
                    "<h2>Pendahuluan</h2>\n" .
                    "<p>(paragraf 1: jelaskan masalah yang dihadapi pembaca dengan bahasa yang empatik dan relatable)</p>\n" .
                    "<p>(paragraf 2: jelaskan dampak jika masalah tidak diselesaikan dan kebutuhan pembaca)</p>\n" .
                    "<p>(paragraf 3: perkenalkan solusi yang ditawarkan buku ini dengan meyakinkan)</p>\n" .
                    "<p>(paragraf 4: jelaskan manfaat dan hasil yang akan didapat setelah membaca buku)</p>\n\n" .
                    "<h2>Untuk Siapa Buku Ini</h2>\n" .
                    "<p>(paragraf 1: deskripsikan persona calon pembaca dengan detail dan situasi mereka)</p>\n" .
                    "<p>(paragraf 2: jelaskan hasil spesifik yang mereka cari dan mengapa buku ini cocok untuk mereka)</p>\n\n" .
                    "<h2>Cara Menggunakan Buku Ini</h2>\n" .
                    "<p>(paragraf 1: jelaskan struktur umum buku dan alur pembahasan dari bab ke bab)</p>\n" .
                    "<p>(paragraf 2: berikan tips cara praktis membaca dan menerapkan isi buku untuk hasil maksimal)</p>\n\n" .
                    "CATATAN PENTING:\n" .
                    "- HANYA BUAT BAGIAN PENDAHULUAN SAJA.\n" .
                    "- JANGAN GUNAKAN sub-heading seperti 'Masalah:', 'Kebutuhan:', 'Solusi:', dll.\n" .
                    "- JANGAN BUAT DAFTAR ISI di bagian ini.\n" .
                    "- JANGAN BUAT ISI BAB apapun di bagian ini.\n" .
                    "- JANGAN BUAT BAGIAN 'Pengantar Penulis' di sini.\n" .
                    "- Tulis dalam bentuk PARAGRAF NARATIF yang mengalir natural.\n" .
                    "- Integrasikan Masalah, Kebutuhan, Solusi secara natural dalam narasi tanpa label eksplisit.\n" .
                    "- Total minimal 600 kata.\n" .
                    "- Gunakan pengalaman penulis (Experience) sebagai konteks/cerita singkat yang relevan di dalam narasi.\n" .
                    "- Jika pengalaman kosong, abaikan bagian ini.\n" .
                    "- Gaya bahasa: {$gaya}\n" .
                    "- STOP setelah selesai menulis bagian 'Cara Menggunakan Buku Ini'.\n" .
                    "- Pastikan setiap paragraf mengalir natural dan tidak terkesan seperti daftar poin.\n";
                break;

            case 'outline':
                $instruction =
                    "BUATKAN DAFTAR ISI LENGKAP SESUAI DENGAN JUMLAH YANG DIMINTA USER.\n" .
                    "Format WAJIB:\n" .
                    "<h2>Daftar Isi</h2>\n" .
                    "<ol>\n" .
                    "<li>Bab 1: Judul Bab 1<ul><li>1.1 Sub-bab pertama</li><li>1.2 Sub-bab kedua</li></ul></li>\n" .
                    "...\n" .
                    "</ol>\n\n" .
                    "Ketentuan PENTING:\n" .
                    "- Total HARUS {$totalBab} Bab (sesuai permintaan user).\n" .
                    "- Setiap Bab HARUS punya {$subBabPerBab} sub-bab (h3).\n" .
                    "- Judul bab/sub-bab harus progresif: dari fondasi -> praktik -> studi kasus -> scaling -> penutup.\n" .
                    "- Semua judul harus MENJAWAB Masalah: '{$masalah}'\n" .
                    "- Semua judul harus MEMENUHI Kebutuhan: '{$kebutuhan}'\n" .
                    "- Semua judul harus MENGARAH KE Solusi: '{$solusi}'\n" .
                    "- Jangan tambahkan penjelasan atau komentar apapun di luar format di atas.\n";
                break;


            case 'chapter':
                // Validasi sub-bab
                if (empty($subBabTitles)) {
                    return response()->json([
                        'status'  => false,
                        'message' => 'Sub-bab tidak ditemukan di daftar isi. Pastikan daftar isi sudah dibuat terlebih dahulu.',
                    ], 400);
                }

                // Buat daftar sub-bab yang HARUS diikuti
                $subBabListExact = "";
                $subBabValidation = "DAFTAR SUB-BAB YANG HARUS DIBUAT (WAJIB IKUTI PERSIS):\n";

                foreach ($subBabTitles as $index => $subBab) {
                    $subBabNumber = $subBab['number'] ?? '';
                    $subBabTitle = $subBab['title'] ?? '';

                    if ($subBabNumber && $subBabTitle) {
                        $subBabValidation .= "{$subBabNumber} {$subBabTitle}\n";
                        $subBabListExact .= "<h3>{$subBabNumber} {$subBabTitle}</h3>\n";
                    }
                }

                $chapterTitle = $chapterTitleFromTOC ?: ($chapterTitle ?: "Judul Bab {$targetChapter}");

                $instruction =
                    "TUGAS ANDA: BUAT BAB {$targetChapter} DENGAN STRUKTUR YANG SUDAH DITENTUKAN.\n\n" .
                    "═══════════════════════════════════════════════════════════════\n" .
                    "INFORMASI BAB:\n" .
                    "═══════════════════════════════════════════════════════════════\n" .
                    "Nomor Bab: {$targetChapter}\n" .
                    "Judul Bab: {$chapterTitle}\n\n" .
                    "═══════════════════════════════════════════════════════════════\n" .
                    "{$subBabValidation}\n" .
                    "═══════════════════════════════════════════════════════════════\n\n" .
                    "⚠️ ATURAN MUTLAK (TIDAK BOLEH DILANGGAR):\n" .
                    "1. WAJIB menggunakan PERSIS judul sub-bab di atas\n" .
                    "2. JANGAN mengubah nomor sub-bab (misalnya {$targetChapter}.1 menjadi 1.1)\n" .
                    "3. JANGAN mengubah atau memodifikasi judul sub-bab\n" .
                    "4. JANGAN menambah sub-bab baru\n" .
                    "5. JANGAN mengurangi sub-bab yang sudah ditentukan\n" .
                    "6. JANGAN mengubah urutan sub-bab\n" .
                    "7. Nomor sub-bab HARUS dimulai dari {$targetChapter}.1, {$targetChapter}.2, dst\n\n" .
                    "FORMAT OUTPUT YANG HARUS DIHASILKAN:\n" .
                    "═══════════════════════════════════════════════════════════════\n" .
                    "<h2>Bab {$targetChapter}: {$chapterTitle}</h2>\n\n" .
                    "<p>Pengantar bab (2-3 paragraf yang menjelaskan):</p>\n" .
                    "<p>- Mengapa bab ini penting untuk menyelesaikan masalah pembaca</p>\n" .
                    "<p>- Overview singkat tentang apa yang akan dipelajari</p>\n" .
                    "<p>- Manfaat konkret yang akan didapat</p>\n\n" .
                    $subBabListExact .
                    "\n<blockquote>\n" .
                    "<p><strong>💡 Tips & Kesalahan yang Harus Dihindari:</strong></p>\n" .
                    "<ul>\n<li>Tip praktis 1</li>\n<li>Tip praktis 2</li>\n<li>Tip praktis 3</li></ul>\n" .
                    "</blockquote>\n\n" .
                    "<p>Penutup bab (2 paragraf):</p>\n" .
                    "<p>- Rangkuman poin-poin kunci</p>\n" .
                    "<p>- Action plan konkret untuk 24-48 jam ke depan</p>\n" .
                    "═══════════════════════════════════════════════════════════════\n\n" .
                    "KETENTUAN KONTEN:\n" .
                    "1. Total minimal 1800 kata untuk seluruh bab\n" .
                    "2. Setiap sub-bab minimal 300-400 kata (3-5 paragraf)\n" .
                    "3. Setiap sub-bab HARUS berisi:\n" .
                    "   ✓ Penjelasan konsep dengan jelas dan mudah dipahami\n" .
                    "   ✓ Contoh konkret atau studi kasus nyata\n" .
                    "   ✓ Langkah-langkah praktis yang actionable\n" .
                    "   ✓ Tips menghindari kesalahan umum\n" .
                    "4. Gunakan pengalaman penulis: {$pengalaman}\n" .
                    "5. Tunjukkan kompetensi penulis: {$kompetensi}\n" .
                    "6. Gaya bahasa: {$gaya}\n" .
                    "7. Fokus pada solusi praktis untuk masalah: {$masalah}\n" .
                    "8. Pastikan alur antar sub-bab mengalir natural\n\n" .
                    "CONTOH FORMAT SUB-BAB YANG BENAR:\n" .
                    "─────────────────────────────────────────────────────────────\n" .
                    "<h3>{$targetChapter}.1 [Judul Sub-bab Sesuai Daftar Isi]</h3>\n" .
                    "<p>Paragraf 1: Penjelasan konsep utama...</p>\n" .
                    "<p>Paragraf 2: Mengapa ini penting...</p>\n" .
                    "<p>Paragraf 3: Contoh konkret atau studi kasus...</p>\n" .
                    "<p>Paragraf 4: Langkah praktis implementasi...</p>\n" .
                    "<p>Paragraf 5: Tips tambahan dan hal yang harus dihindari...</p>\n" .
                    "─────────────────────────────────────────────────────────────\n\n" .
                    "🚀 MULAI MENULIS BAB {$targetChapter} SEKARANG!\n" .
                    "Ingat: IKUTI PERSIS struktur sub-bab yang sudah ditentukan di atas.\n";
                break;


            case 'summary':
                $instruction = "
BUATKAN RINGKASAN EKSEKUTIF:

Format yang HARUS digunakan:
<h2>Ringkasan</h2>
<p>Paragraf pertama: Ringkasan inti masalah dan solusi...</p>
<p>Paragraf kedua: Poin-poin kunci yang dibahas...</p>
<ul>
<li>Poin penting pertama</li>
<li>Poin penting kedua</li>
<li>Poin penting ketiga</li>
</ul>
<p>Paragraf penutup: Manfaat yang didapat pembaca...</p>

Ringkasan harus:
1. Merangkum seluruh konten ebook secara singkat
2. Menyoroti poin-poin kunci
3. Menggunakan bahasa yang powerful dan persuasif
4. Memberikan nilai tambah untuk pembaca
5. Panjang: 300-500 kata
";
                break;

            case 'closing':
                $instruction =
                    "BUATKAN BAGIAN AKHIR BUKU (LENGKAP):\n" .
                    "<h2>Penutup</h2>\n" .
                    "(refleksi, rangkum manfaat, ajakan aksi 7 hari ke depan)\n" .
                    "<blockquote><p>kalimat motivasi yang relevan</p></blockquote>\n" .
                    "<h2>Tentang Penulis</h2>\n" .
                    "(gunakan teks Tentang Penulis jika ada; jika kosong, buat bio kredibel dari Kompetensi)\n\n" .
                    "Ketentuan panjang:\n" .
                    "- Total minimal 600 kata.\n" .
                    "- Tutup dengan CTA yang jelas sesuai solusi.\n";
                break;


            default:
                return response()->json([
                    'status'  => false,
                    'message' => 'Action tidak dikenali.',
                ], 400);
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(60)->post(
                "https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key={$apiKey}",
                [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $basePrompt . "\n\n" . $instruction],
                            ],
                        ],
                    ],
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'topP' => 0.8,
                        'topK' => 40,
                        'maxOutputTokens' => 8000,
                    ]
                ]
            );

            if ($response->failed()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Gagal menghubungi Google AI. Periksa API Key atau quota Anda.',
                ], 500);
            }

            $data = $response->json();
            $html = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';

            // Clean up HTML jika perlu
            $html = $this->cleanEbookHtml($html);
            if ($action === 'intro') {
                $html = $this->validateIntroContent($html);
            }
            if ($action === 'chapter' && !empty($subBabTitles)) {
                $html = $this->validateChapterSubBabs($html, $subBabTitles, $targetChapter);

                // Tambahan: Perbaiki nomor sub-bab jika salah
                foreach ($subBabTitles as $subBab) {
                    $correctNumber = $subBab['number']; // Misal: "1.1"
                    $wrongNumber = substr($correctNumber, strpos($correctNumber, '.') + 1); // Ambil angka setelah titik

                    // Ganti format salah seperti "1.1" dengan "{$targetChapter}.1"
                    $html = preg_replace(
                        "/<h3>{$wrongNumber}\s+/i",
                        "<h3>{$correctNumber} ",
                        $html
                    );
                }
            }
            $minWords = match ($action) {
                'title' => 1,      // ✅ judul cukup 1 kata pun boleh
                'outline' => 50,   // (opsional) daftar isi tidak perlu panjang
                'intro' => 900,
                'chapter' => 1600,
                'summary' => 500,
                'closing' => 600,
                default => 200,
            };

            $loops = 0;

            // ✅ Jangan “lanjutkan teks” untuk TITLE / OUTLINE
            if (!in_array($action, ['title', 'outline'], true)) {
                while ($this->textWordCount($html) < $minWords && $loops < 2) {
                    $loops++;

                    $continuePrompt = $basePrompt;

                    // ✅ TAMBAHKAN kondisi khusus untuk intro
                    if ($action === 'intro') {
                        $continuePrompt .=
                            "LANJUTKAN HANYA BAGIAN PENDAHULUAN.\n" .
                            "JANGAN buat daftar isi atau isi bab.\n" .
                            "JANGAN gunakan heading 'Bab 1', 'Bab 2', dll.\n" .
                            "Fokus pada penjelasan masalah, target pembaca, dan cara menggunakan buku.\n\n";
                    }

                    $continuePrompt .=
                        "LANJUTKAN teks berikut TANPA mengulang. Mulai tepat setelah kalimat terakhir.\n" .
                        "Jangan buat h1/h2 baru kecuali memang lanjutan natural dari struktur.\n" .
                        "Gunakan HTML tag yang sama (p,h3,ul,ol,li,blockquote).\n\n" .
                        "TEKS SAAT INI:\n" . $html;

                    $resp2 = Http::withHeaders(['Content-Type' => 'application/json'])
                        ->timeout(120)
                        ->post("https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key={$apiKey}", [
                            'contents' => [['parts' => [['text' => $continuePrompt]]]],
                            'generationConfig' => [
                                'temperature' => 0.7,
                                'topP' => 0.85,
                                'topK' => 40,
                                'maxOutputTokens' => 8000,
                            ]
                        ]);

                    if ($resp2->failed()) break;

                    $more = $resp2->json()['candidates'][0]['content']['parts'][0]['text'] ?? '';
                    $more = $this->cleanEbookHtml($more);

                    $html = trim($html) . "\n" . trim($more);
                }
            }


            return response()->json([
                'status' => true,
                'html'   => $html,
                'chapter_number' => $chapterNumber,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Terjadi error: ' . $e->getMessage(),
            ], 500);
        }
    }

    private function textWordCount(string $html): int
    {
        $t = strip_tags($html);
        $t = preg_replace('/\s+/', ' ', trim($t));
        if ($t === '') return 0;
        return count(explode(' ', $t));
    }


    private function parseOutlineSpec(string $raw): array
    {
        $raw = strtolower(trim($raw));
        $bab = 5; // default
        $sub = 5; // default

        if ($raw === '') return [$bab, $sub];

        // Pattern untuk mendeteksi format: "5 Bab 5 Sub Bab" atau "3 Bab 4 Sub"
        // atau "7 bab 3 sub bab" atau "5 5"
        if (preg_match('/(\d+)\s*(?:bab)?\s*(\d+)?\s*(?:sub)?/i', $raw, $matches)) {
            if (isset($matches[1])) {
                $bab = max(1, min(50, intval($matches[1])));
            }
            if (isset($matches[2])) {
                $sub = max(1, min(20, intval($matches[2])));
            } else {
                // Jika hanya satu angka, gunakan default untuk sub-bab
                $sub = 5;
            }
        }

        return [$bab, $sub];
    }


    private function validateChapterSubBabs($html, $expectedSubBabs, $chapterNumber)
    {
        if (empty($expectedSubBabs)) {
            return $html;
        }

        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        @$doc->loadHTML('<?xml encoding="UTF-8">' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $h3Tags = $doc->getElementsByTagName('h3');
        $foundSubBabs = [];

        foreach ($h3Tags as $h3) {
            $text = trim($h3->textContent);
            $foundSubBabs[] = $text;
        }

        // Log untuk debugging
        \Log::info("Expected sub-babs for Chapter {$chapterNumber}:", array_map(function ($sb) {
            return $sb['number'] . ' ' . $sb['title'];
        }, $expectedSubBabs));
        \Log::info("Found sub-babs in generated content:", $foundSubBabs);

        // Hitung kecocokan
        $expectedCount = count($expectedSubBabs);
        $foundCount = count($foundSubBabs);

        if ($foundCount !== $expectedCount) {
            \Log::warning("Sub-bab count mismatch: Expected {$expectedCount}, Found {$foundCount}");
        }

        return $html;
    }

    private function cleanEbookHtml($html)
    {
        $html = preg_replace('/```html/i', '', $html);
        $html = preg_replace('/```/i', '', $html);
        // Hapus tag yang tidak diinginkan
        $html = preg_replace('/<div[^>]*>/', '', $html);
        $html = preg_replace('/<\/div>/', '', $html);
        $html = preg_replace('/<span[^>]*>/', '', $html);
        $html = preg_replace('/<\/span>/', '', $html);

        // Hapus atribut style, class, id
        $html = preg_replace('/(<[^>]+) style="[^"]*"/', '$1', $html);
        $html = preg_replace('/(<[^>]+) class="[^"]*"/', '$1', $html);
        $html = preg_replace('/(<[^>]+) id="[^"]*"/', '$1', $html);

        // Normalize line breaks
        $html = str_replace("\r", "", $html);
        $html = preg_replace('/\n\s*\n+/', "\n\n", $html);

        // Ensure proper HTML structure
        $html = trim($html);

        return $html;
    }

    private function validateIntroContent($html)
    {
        // Cek apakah ada kata-kata yang mengindikasikan isi bab
        $forbiddenPatterns = [
            '/Bab\s+\d+:/i',           // Mencegah "Bab 1:", "Bab 2:", dll
            '/<h2>Bab\s+\d+/i',        // Mencegah heading bab
            '/Sub-?bab/i',             // Mencegah penyebutan sub-bab
            '/<h3>\d+\.\d+/i',         // Mencegah format sub-bab seperti "1.1"
        ];

        foreach ($forbiddenPatterns as $pattern) {
            if (preg_match($pattern, $html)) {
                // Potong konten setelah bagian terlarang ditemukan
                $html = preg_split($pattern, $html)[0];
                break;
            }
        }

        return $html;
    }

    public function downloadPDF(Request $request)
    {
        $html = $request->input('html');

        // CSS khusus PDF
        $css = "
        <style>
            body { font-family: 'Times New Roman', serif; line-height: 1.6; font-size: 12pt; }

            h1 { font-size: 28px; font-weight: bold; text-align: center; margin-bottom: 20px; }
            h2 { font-size: 22px; font-weight: bold; margin-top: 25px; margin-bottom: 15px; }
            h3 { font-size: 18px; font-weight: bold; margin-top: 20px; margin-bottom: 10px; }

            p { margin-bottom: 12px; text-align: justify; }

            ul, ol { margin-left: 20px; margin-bottom: 15px; }
            li { margin-bottom: 5px; }

            blockquote {
                border-left: 4px solid #ccc;
                padding-left: 15px;
                font-style: italic;
                margin: 15px 0;
            }

            .section-container { page-break-inside: avoid; margin-bottom: 25px; }

            /* ❌ Sembunyikan tombol di PDF */
            .action-buttons { display: none !important; }
            .chapter-badge { display: none !important; }

            /* Daftar isi */
            .toc-container { background: #f0f0f0; padding: 15px; border-radius: 6px; margin-bottom: 20px; }
            .toc-container li { padding: 5px 0; border-bottom: 1px solid #ccc; }
            .toc-container li:last-child { border-bottom: none; }
        </style>
    ";

        $finalHTML = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='utf-8'>
            {$css}
        </head>
        <body>
            {$html}
        </body>
        </html>
    ";

        $pdf = \PDF::loadHTML($finalHTML)
            ->setPaper('A4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);

        return $pdf->download('ebook.pdf');
    }
}
