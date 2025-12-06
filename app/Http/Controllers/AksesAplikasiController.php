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
            'action'      => 'required|in:title,intro,outline,chapter,summary,closing',
            'masalah'     => 'required',
            'gaya'        => 'required',
            'jumlah_bab'  => 'nullable|integer|min:1|max:50',
            'penulis'     => 'nullable|string',
            'existing_title' => 'nullable|string',
            'current_chapter_count' => 'nullable|integer|min:0',
            'chapter_titles' => 'nullable|array',
            'target_chapter' => 'nullable|integer|min:1',
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
        $gaya       = $request->gaya;
        $jumlahBab  = $request->jumlah_bab ?? 3;
        $penulis    = $request->penulis ?? '';
        $action     = $request->action;
        $existingTitle = $request->existing_title;
        $currentChapterCount = $request->current_chapter_count ?? 0;
        $chapterTitles = $request->chapter_titles ?? [];
        $targetChapter = $request->target_chapter ?? ($currentChapterCount + 1);

        // Base prompt dengan instruksi format yang lebih baik
        $basePrompt = "Kamu adalah asisten penulis ebook profesional berbahasa Indonesia.\n"
            . "Tugasmu membuat konten ebook dalam format HTML yang clean dan rapih.\n"
            . "**ATURAN FORMAT:**\n"
            . "1. Gunakan HANYA tag HTML dasar: h1, h2, h3, p, ul, ol, li, blockquote\n"
            . "2. TIDAK BOLEH menggunakan: style, class, id, div, span, atau atribut apapun\n"
            . "3. Format harus konsisten seperti buku profesional\n"
            . "4. Gunakan struktur yang logis dan mudah dibaca\n\n"
            . "**KONTEKS:**\n"
            . "Gaya bahasa: {$gaya}\n"
            . "Masalah utama: {$masalah}\n";

        if (!empty($existingTitle) && $action !== 'title') {
            $basePrompt .= "Judul ebook yang sudah dibuat: " . strip_tags($existingTitle) . "\n";
        }

        if (!empty($penulis)) {
            $basePrompt .= "Bio penulis: {$penulis}\n";
        }

        $chapterNumber = $currentChapterCount + 1;

        switch ($action) {
            case 'title':
                $instruction = "
BUATKAN JUDUL EBOOK YANG MENARIK:

Format yang HARUS digunakan:
<h1>Judul Utama Ebook</h1>
<p>Subjudul atau tagline yang mendukung</p>

Contoh format yang benar:
<h1>Mastering Productivity: Seni Menyelesaikan Pekerjaan</h1>
<p>Strategi Praktis untuk Meningkatkan Efisiensi Kerja Harian</p>

Judul harus:
1. Relevan dengan masalah: {$masalah}
2. Menggunakan gaya bahasa: {$gaya}
3. Cukup panjang (4-8 kata)
4. Memiliki subjudul yang mendukung
5. Menarik perhatian pembaca
";
                break;

            case 'intro':
                $instruction = "
BUATKAN BAGIAN PENDAHULUAN EBOOK:

Format yang HARUS digunakan:
<h2>Pendahuluan</h2>
<p>Paragraf pembukaan yang menarik...</p>
<p>Penjelasan tentang pentingnya topik...</p>
<p>Struktur ebook secara singkat...</p>

Pendahuluan harus:
1. Membuka dengan kalimat yang menarik perhatian
2. Menjelaskan mengapa masalah ini penting
3. Memberikan gambaran tentang apa yang akan dipelajari
4. Menggunakan 3-5 paragraf yang koheren
5. Ditulis dengan gaya {$gaya}
";
                break;

            case 'outline':
                $totalBab = max($jumlahBab, $request->existing_chapter_count ?? 0);

                $instruction = "
BUATKAN DAFTAR ISI PROFESIONAL:

Format yang HARUS digunakan:
<h2>Daftar Isi</h2>
<ol>
";

                if ($request->existing_chapter_titles && is_array($request->existing_chapter_titles)) {
                    $existingTitles = $request->existing_chapter_titles;
                    for ($i = 0; $i < $totalBab; $i++) {
                        $babNum = $i + 1;
                        $title = $existingTitles[$i] ?? "Judul Bab {$babNum} yang relevan dengan masalah";
                        $instruction .= "<li>Bab {$babNum}: " . strip_tags($title) . "</li>\n";
                    }
                } else {
                    for ($i = 1; $i <= $totalBab; $i++) {
                        $instruction .= "<li>Bab {$i}: [Buat judul bab yang relevan dengan masalah: {$masalah}]</li>\n";
                    }
                }

                $instruction .= "</ol>

Judul bab harus:
1. Relevan dengan masalah: {$masalah}
2. Urut dan progresif (dari dasar ke lanjutan)
3. Menggunakan kata kerja yang kuat
4. Mencerminkan konten yang akan dibahas
5. Maksimal 8 kata per judul
";
                break;

            case 'chapter':
                $chapterTitle = '';
                if (isset($chapterTitles[$targetChapter - 1])) {
                    $chapterTitle = strip_tags($chapterTitles[$targetChapter - 1]);
                    $basePrompt .= "\n**JUDUL BAB YANG HARUS DIGUNAKAN:** {$chapterTitle}\n";
                } else {
                    $basePrompt .= "\nIni adalah bab tambahan. Buat bab yang relevan dengan masalah.\n";
                }

                $instruction = "
BUATKAN SATU BAB LENGKAP UNTUK EBOOK:

Format yang HARUS digunakan:
<h2>Bab {$targetChapter}: " . ($chapterTitle ?: "Judul Bab yang Relevan") . "</h2>
<p>Paragraf pembukaan bab...</p>
<h3>Subjudul pertama</h3>
<p>Penjelasan untuk subjudul pertama...</p>
<ul>
<li>Poin penting pertama</li>
<li>Poin penting kedua</li>
</ul>
<h3>Subjudul kedua</h3>
<p>Penjelasan untuk subjudul kedua...</p>
<blockquote>
<p>Kutipan atau tips penting jika relevan</p>
</blockquote>
<p>Paragraf penutup bab...</p>

Struktur bab harus:
1. Dibuka dengan paragraf pengantar
2. Memiliki 2-3 subjudul (h3) yang logis
3. Menggunakan poin-poin (ul/ol) untuk penjelasan
4. Menyertakan contoh atau studi kasus jika relevan
5. Ditutup dengan rangkuman atau transisi ke bab berikutnya
7. Menggunakan gaya bahasa: {$gaya}
";
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
                $instruction = "
BUATKAN PENUTUP YANG MEMOTIVASI:

Format yang HARUS digunakan:
<h2>Penutup</h2>
<p>Paragraf pertama: Refleksi tentang perjalanan belajar...</p>
<p>Paragraf kedua: Ajakan untuk bertindak...</p>
<blockquote>
<p>Kutipan inspiratif atau motivasi terakhir</p>
</blockquote>
<p>Paragraf akhir: Harapan untuk pembaca...</p>

Penutup harus:
1. Memberikan rasa pencapaian kepada pembaca
2. Mengajak untuk menerapkan ilmu yang didapat
3. Menggunakan bahasa yang inspiratif dan memotivasi
4. Memberikan pandangan ke depan
5. Panjang: 200-400 kata
";
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
