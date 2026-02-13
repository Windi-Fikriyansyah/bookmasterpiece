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
            'action' => 'required|in:title,preface,intro,outline,chapter,summary,closing,daftarpustaka,profilpenulis,continue_chapter,continue_subbab,continue_intro_part,extend_outline,continue_preface,continue_summary,continue_closing',
            'masalah' => 'nullable|string',
            'kebutuhan' => 'nullable|string',
            'solusi' => 'nullable|string',
            'pengalaman' => 'nullable|string',
            'kompetensi' => 'nullable|string',
            'calon_pembaca' => 'nullable|string',
            'pengantar_penulis' => 'nullable|string',
            'tentang_penulis' => 'nullable|string',
            'gaya' => 'nullable|string',
            'references' => 'nullable|array',
            'jumlah_outline' => 'nullable|string', // "5 Bab 5 Sub Bab"
            'existing_title' => 'nullable|string',
            'current_chapter_count' => 'nullable|integer|min:0',
            'chapter_titles' => 'nullable|array',
            'target_chapter' => 'nullable|integer|min:1',
            'chapter_title_from_toc' => 'nullable|string', // ✅ Tambahkan ini
            'sub_bab_titles' => 'nullable|array',
            'kontrak_kreatif' => 'nullable|string',

            'chapter_html' => 'nullable|string',
            'chapter_number' => 'nullable|integer|min:1',
            'chapter_title' => 'nullable|string',

            'subbab_number' => 'nullable|string',
            'subbab_title' => 'nullable|string',
            'subbab_text' => 'nullable|string',

            'intro_heading' => 'nullable|string',
            'intro_text' => 'nullable|string',
            'intro_html' => 'nullable|string',

            'extend_mode'         => 'nullable|in:add_chapter,add_subbab',
            'outline_html'        => 'nullable|string',
            'next_chapter_number' => 'nullable|integer|min:1',

            'chapter_number'      => 'nullable|integer|min:1',
            'last_subbab_index'   => 'nullable|integer|min:0',
            'add_count'           => 'nullable|integer|min:1|max:5',

            'preface_text' => 'nullable|string',
            'preface_html' => 'nullable|string',

            'summary_text' => 'nullable|string',
            'summary_html' => 'nullable|string',



        ]);

        $user = DB::table('users')->where('id', auth()->id())->first();

        if (!env('OPENROUTER_API_KEY')) {
            return response()->json([
                'status'  => false,
                'message' => 'OpenRouter API Key belum dikonfigurasi di server. Silakan hubungi admin.',
            ], 400);
        }

        $apiKey     = env('OPENROUTER_API_KEY');
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
        $kontrakKreatif = $request->kontrak_kreatif ?? '';


        $chapterTitleFromTOC = $request->chapter_title_from_toc ?? '';
        $subBabTitles = $request->sub_bab_titles ?? [];

        // Base prompt dengan instruksi format yang lebih baik
        $basePrompt = <<<PROMPT
Kamu adalah asisten penulis buku profesional yang ahli menulis buku best seller persuasif berbahasa Indonesia.

Tugasmu adalah menghasilkan bagian buku yang diminta berdasarkan ACTION sistem dengan gaya yang:
- Emosional namun elegan
- Menggugah namun tidak lebay
- Tajam namun tetap humanis
- Mampu membuat pembaca merasa dipahami
- Memiliki daya dorong untuk bertindak

Tulisan harus terasa seperti ditulis oleh penulis berpengalaman yang memahami psikologi pembaca.

════════════════════════════════════════
PRINSIP PENULISAN BEST SELLER
════════════════════════════════════════
1. Gunakan HOOK di awal setiap bagian (kalimat yang langsung menarik emosi atau rasa ingin tahu).
2. Sentuh rasa frustrasi pembaca secara spesifik.
3. Buat pembaca merasa: “Ini tentang saya.”
4. Gunakan sapaan “KAMU” atau "ANDA" bila sesuai dengan gaya bahasa.
5. Bangun ketegangan → berikan harapan → tawarkan solusi.
6. Hindari teori kering tanpa contoh nyata.
7. Sisipkan ilustrasi, analogi, atau cerita singkat bila relevan.
8. Gunakan kalimat variatif (pendek untuk impact, panjang untuk penjelasan).
9. Jangan pernah menyebut AI atau instruksi sistem.

════════════════════════════════════════
KERANGKA PSIKOLOGI PEMBACA (WAJIB TERINTEGRASI)
════════════════════════════════════════
Problem → Buat pembaca sadar masalahnya.
Need → Buat pembaca merasa butuh solusi.
Agitation → Perjelas dampak jika tidak berubah.
Solution → Berikan sistem/metode konkret.
Hope → Berikan keyakinan bahwa perubahan mungkin.
Action → Arahkan ke langkah nyata.

════════════════════════════════════════
ATURAN FORMAT OUTPUT (WAJIB)
════════════════════════════════════════
- Output HARUS HTML bersih tanpa atribut.
- Hanya gunakan: h1, h2, h3, p, ul, ol, li, blockquote.
- Jangan gunakan div, span, style, class, id.
- Jangan buat bagian di luar ACTION yang diminta.

════════════════════════════════════════
KONTEKS BUKU (WAJIB MENJADI DASAR)
════════════════════════════════════════
Masalah Utama:
{$masalah}

Kebutuhan:
{$kebutuhan}

Solusi:
{$solusi}

Pengalaman Penulis:
{$pengalaman}

Kompetensi Penulis:
{$kompetensi}

Target Pembaca:
{$calonPembaca}

Gaya Bahasa:
{$gaya}

Target Struktur:
{$totalBab} Bab, ± {$subBabPerBab} Sub-bab per Bab
PROMPT;

        if (!empty($existingTitle) && $action !== 'title') {
            $basePrompt .= "\nJudul Buku:\n" . strip_tags($existingTitle) . "\n";
        }

        if (!empty($kontrakKreatif)) {
            $basePrompt .= "\nKONTRAK KREATIF TAMBAHAN:\n{$kontrakKreatif}\n";
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
                $instruction = <<<PROMPT
ACTION: title
- Buat:
  <h1>Judul Buku</h1>
  <p>Tagline persuasif maksimal 16 kata</p>
- Judul harus kuat secara emosional dan menjanjikan transformasi.
- Hindari judul klise yang terlalu umum.
- Buat pembaca penasaran dan ingin membaca.
PROMPT;
                $instruction = trim($instruction);
                break;


            case 'preface':
                $instruction = <<<PROMPT
ACTION: preface
- <h2>Kata Pengantar</h2>
- Awali dengan kalimat ungkapan syukur dan terima kasih, dan emosional atau reflektif.
- Bangun kedekatan dengan pembaca.
- Minimal 350 kata.
- Tutup dengan satu kalimat kuat dalam <blockquote>.
PROMPT;
                $instruction = trim($instruction);
                break;

            case 'profilpenulis':
                $instruction = <<<PROMPT
ACTION: profilpenulis
- <h2>Profil Penulis</h2>
- Orang ketiga.
- Tampilkan kredibilitas dan perjalanan nyata.
- Profesional namun tetap humanis.

Informasi Penulis:
- Nama: {$nama}
- Bio/Tentang: {$bio}
- Kompetensi: {$kompetensi}
- Pengalaman: {$pengalaman}
PROMPT;
                $instruction = trim($instruction);
                break;





            case 'intro':
                $instruction = <<<PROMPT
ACTION: intro
- <h2>Pendahuluan</h2>
- Awali dengan fenomena atau pertanyaan tajam.
- Bangun urgensi.
- Integrasikan problem–agitation–solution secara natural.
- Minimal satu halaman.
PROMPT;
                $instruction = trim($instruction);
                break;


            case 'outline':
                $instruction = <<<PROMPT
ACTION: outline
- Buat <h2>Daftar Isi</h2> + <ol>.
- Struktur progresif untuk {$totalBab} Bab sesuai permintaan. Setiap bab harus terasa seperti langkah esensial dalam perjalanan transformasi pembaca:
  Bab 1–2 → Kesadaran & Mindset (Menggali masalah, memicu kebutuhan, mengubah perspektif)
  Bab 3–4 → Sistem & Strategi (Menawarkan solusi konkret, langkah-langkah praktis)
  Bab 5–6 → Implementasi & Studi Kasus (Membangun harapan, menunjukkan bukti, mendorong tindakan)
  Bab akhir → Transformasi & Action Plan (Mengukuhkan perubahan, memberikan dorongan akhir)
- Gunakan format: <li>Bab X: Judul Bab yang Menggugah<ul><li>X.1 Subjudul yang Menjanjikan</li>...</ul></li>
- Semua judul (bab dan sub-bab) harus terasa hidup, emosional, dan menjanjikan solusi, bukan kaku akademik.
PROMPT;
                break;


            case 'chapter':
                if (empty($subBabTitles)) {
                    return response()->json([
                        'status'  => false,
                        'message' => 'Sub-bab tidak ditemukan di daftar isi. Pastikan daftar isi sudah dibuat terlebih dahulu.',
                    ], 400);
                }

                $subBabValidation = "DAFTAR SUB-BAB YANG HARUS DIBUAT (WAJIB IKUTI PERSIS):\n";
                foreach ($subBabTitles as $index => $sb) {
                    $subBabValidation .= "{$sb['number']} {$sb['title']}\n";
                }

                $chapterTitle = $chapterTitleFromTOC ?: "Bab {$targetChapter}";

                $instruction = <<<PROMPT
ACTION: chapter
- <h2>Bab {$targetChapter}: {$chapterTitle}</h2>
- Setiap sub-bab:
  - Awali dengan hook singkat (tarik emosi pembaca).
  - Jelaskan konsep dengan contoh nyata/studi kasus.
  - Berikan langkah praktis (actionable).
  - JANGAN lupakan kerangka psikologi: Problem-Need-Agitation-Solution-Hope-Action.
  - Sisipkan minimal 6 kutipan total per bab dengan format [C1], [C2], dst.
- Total minimal 1800 kata.
- Tutup bab dengan:
  - Ringkasan emosional yang menyentuh.
  - Action plan konkret untuk 24–48 jam ke depan.

SUB-BAB YANG WAJIB DIIKUTI:
{$subBabValidation}

WAJIB buat blok referensi di paling bawah:
<h3>Referensi Bab (auto)</h3>
<ul>
  <li>[C1] Referensi lengkap...</li>
</ul>
PROMPT;
                break;




            case 'summary':
                $ctx = trim($request->summary_context ?? '');
                $instruction = <<<PROMPT
ACTION: summary
- <h2>Ringkasan dan Kesimpulan Seluruh Isi Buku</h2>
- Ringkas perjalanan transformasi pembaca dari awal hingga akhir. Sentuh emosi mereka, tegaskan perubahan yang telah terjadi.
- Buat pembaca merasa perjalanan ini utuh, berharga, dan penuh makna.
- Berikan dorongan kuat untuk terus menerapkan pembelajaran.
- Minimal 500 kata.

SUMMARY_CONTEXT (SUMBER KESIMPULAN):
{$ctx}
PROMPT;
                $instruction = trim($instruction);
                break;




            case 'closing':
                $instruction = <<<PROMPT
ACTION: closing
- <h2>Penutup</h2>
- Tulis refleksi kuat yang menggugah emosi, mengingatkan pembaca akan perjalanan dan transformasi yang telah mereka lalui.
- Tegaskan kembali nilai dan dampak dari solusi yang ditawarkan.
- Beri dorongan aksi nyata (Call to Action) yang inspiratif dan membakar semangat.
- Tutup dengan kalimat yang membekas dalam <blockquote>, meninggalkan kesan mendalam dan motivasi abadi.
PROMPT;
                $instruction = trim($instruction);
                break;



            case 'daftarpustaka':
                $refs = $request->references ?? [];
                // Jika referensi kosong, minta AI buatkan yang valid
                if (empty($refs)) {
                    $instruction = <<<PROMPT
ACTION: daftarpustaka
- <h2>Daftar Pustaka</h2>
- <ol>...</ol>
- Urutkan secara alfabetis.
- Buat daftar referensi yang valid dan kredibel (buku cetak, artikel ilmiah, jurnal, atau sumber online terpercaya) yang relevan dengan topik buku. Referensi harus mendukung argumen dan solusi yang disajikan.
PROMPT;
                    break;
                }

                $refs = array_map(function ($r) {
                    $r = trim((string)$r);
                    $r = preg_replace('/^\[\s*C\d+\s*\]\s*/i', '', $r);
                    return $r;
                }, $refs);

                $refs = array_values(array_filter($refs));
                $refs = array_values(array_unique($refs));
                natcasesort($refs);
                $refs = array_values($refs);

                $html = "<h2>Daftar Pustaka</h2><ol>";
                foreach ($refs as $r) {
                    $safe = htmlspecialchars($r, ENT_QUOTES, 'UTF-8');
                    $html .= "<li>{$safe}</li>";
                }
                $html .= "</ol>";

                return response()->json([
                    'status' => true,
                    'html' => $html
                ]);
                break;


            case 'continue_chapter':
                $instruction = <<<PROMPT
ACTION: continue_*
- Lanjutkan bab tanpa mengulang kalimat sebelumnya.
- Tambahkan kedalaman emosi, analogi yang kuat, dan contoh konkret yang relevan.
- Pastikan konsisten dengan gaya persuasif best seller dan kerangka psikologi pembaca.
- Fokus pada Problem-Agitation-Solution-Hope-Action.

TEKS SAAT INI (JANGAN DIULANG):
{$request->chapter_html}
PROMPT;
                break;

            case 'continue_subbab':
                $instruction = <<<PROMPT
ACTION: continue_*
- Lanjutkan sub-bab tanpa mengulang.
- Tambahkan kedalaman emosi, analogi yang kuat, dan contoh konkret yang relevan.
- Pastikan konsisten dengan gaya persuasif best seller dan kerangka psikologi pembaca.
- Fokus pada Problem-Agitation-Solution-Hope-Action.

TEKS SAAT INI (JANGAN DIULANG):
{$request->subbab_text}
PROMPT;
                break;

            case 'continue_intro_part':
                $instruction = <<<PROMPT
ACTION: continue_*
- Lanjutkan pendahuluan tanpa mengulang.
- Tambahkan urgensi emosional dan kedalaman narasi yang lebih kuat.
- Pastikan konsisten dengan gaya persuasif best seller dan kerangka psikologi pembaca.
- Fokus pada Problem-Agitation-Solution-Hope-Action.

TEKS SAAT INI (JANGAN DIULANG):
{$request->intro_text}
PROMPT;
                break;


            case 'extend_outline':
                $mode = $request->extend_mode ?? 'add_chapter';

                if ($mode === 'add_chapter') {
                    $next = (int)($request->next_chapter_number ?? ($totalBab + 1));
                    $instruction =
                        "TUGAS: TAMBAH 1 BAB BARU KE DAFTAR ISI.\n\n" .
                        "Nomor bab yang harus dibuat: {$next}\n" .
                        "Sub-bab per bab target: {$subBabPerBab}\n\n" .
                        "ATURAN OUTPUT:\n" .
                        "- Output HANYA 1 item <li> untuk bab baru, format WAJIB:\n" .
                        "  <li>Bab {$next}: Judul Bab<ul><li>{$next}.1 Judul Sub-bab</li>...</ul></li>\n" .
                        "- Jangan sertakan <h2>, <ol>, atau teks lain.\n" .
                        "- Judul harus nyambung dengan masalah & solusi buku, serta memicu rasa penasaran dan harapan.\n" .
                        "- Gaya bahasa judul: ringkas, kuat, progresif, dan emosional.\n";
                } else {
                    $chapterNum = (int)($request->chapter_number ?? 1);
                    $lastIdx    = (int)($request->last_subbab_index ?? 0);
                    $addCount   = (int)($request->add_count ?? 2);

                    $start = $lastIdx + 1;

                    $instruction =
                        "TUGAS: TAMBAH SUB-BAB KE BAB {$chapterNum} DI DAFTAR ISI.\n\n" .
                        "Sub-bab terakhir saat ini: {$chapterNum}.{$lastIdx}\n" .
                        "Tambahkan: {$addCount} sub-bab baru dimulai dari {$chapterNum}.{$start}\n\n" .
                        "ATURAN OUTPUT:\n" .
                        "- Output HANYA beberapa <li> sub-bab (tanpa <ul>), contoh:\n" .
                        "  <li>{$chapterNum}.{$start} Judul Sub-bab</li>\n" .
                        "- Jangan tulis bab utama.\n" .
                        "- Jangan sertakan <h2>, <ol>, atau teks lain.\n" .
                        "- Judul harus progresif, relevan dengan masalah & solusi, dan menjanjikan langkah konkret atau pencerahan.\n";
                }
                break;

            case 'continue_preface':
                $instruction = <<<PROMPT
ACTION: continue_*
- Lanjutkan kata pengantar tanpa mengulang.
- Tambahkan sentuhan reflektif dan kedekatan emosional yang lebih dalam.
- Pastikan konsisten dengan gaya persuasif best seller dan kerangka psikologi pembaca.

TEKS SAAT INI (JANGAN DIULANG):
{$request->preface_text}
PROMPT;
                break;


            case 'continue_summary':
                $instruction = <<<PROMPT
ACTION: continue_*
- Lanjutkan ringkasan tanpa mengulang.
- Perdalam poin-poin transformasi, sentuh emosi pembaca tentang pencapaian mereka.
- Pastikan konsisten dengan gaya persuasif best seller dan kerangka psikologi pembaca.

TEKS SAAT INI (JANGAN DIULANG):
{$request->summary_text}
PROMPT;
                break;

            case 'continue_closing':
                $instruction = <<<PROMPT
ACTION: continue_*
- Lanjutkan penutup tanpa mengulang.
- Tambahkan dorongan aksi yang lebih kuat dan membekas.
- Konsisten dengan gaya persuasif best seller.

TEKS SAAT INI (JANGAN DIULANG):
{$request->closing_text}
PROMPT;
                break;


            default:
                return response()->json([
                    'status'  => false,
                    'message' => 'Action tidak dikenali.',
                ], 400);
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(120)->post(
                "https://openrouter.ai/api/v1/chat/completions",
                [
                    'model' => 'arcee-ai/trinity-large-preview:free',
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $basePrompt . "\n\n" . $instruction
                        ],
                    ],
                    'temperature' => 0.7,
                    'top_p' => 0.8,
                ]
            );

            if ($response->failed()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Gagal menghubungi OpenRouter AI. Periksa API Key atau quota Anda.',
                ], 500);
            }

            $data = $response->json();
            $html = $data['choices'][0]['message']['content'] ?? '';

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
                'outline' => 50,
                'preface' => 450, // (opsional) daftar isi tidak perlu panjang
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

                    $resp2 = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $apiKey,
                        'Content-Type' => 'application/json',
                    ])->timeout(120)->post(
                        "https://openrouter.ai/api/v1/chat/completions",
                        [
                            'model' => 'arcee-ai/trinity-large-preview:free',
                            'messages' => [
                                [
                                    'role' => 'user',
                                    'content' => $continuePrompt
                                ],
                            ],
                            'temperature' => 0.7,
                            'top_p' => 0.8,
                        ]
                    );

                    if ($resp2->failed()) break;

                    $more = $resp2->json()['choices'][0]['message']['content'] ?? '';
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

    // Tambahkan fungsi helper untuk parsing summary context yang lebih baik
    private function parseSummaryContextForConclusions($summaryContext)
    {
        $lines = explode("\n", $summaryContext);
        $chapters = [];
        $currentChapter = null;

        foreach ($lines as $line) {
            $line = trim($line);

            // Deteksi bab
            if (preg_match('/^BAB\s+(\d+):\s*(.+)$/i', $line, $matches)) {
                $currentChapter = [
                    'number' => $matches[1],
                    'title' => $matches[2],
                    'content' => '',
                    'subchapters' => []
                ];
                $chapters[] = $currentChapter;
            }
            // Deteksi sub-bab
            elseif (preg_match('/^Sub-?bab:\s*(.+)$/i', $line, $matches) && $currentChapter !== null) {
                $currentChapter['subchapters'][] = $matches[1];
            }
            // Isi bab
            elseif (strpos($line, 'Isi Bab:') !== false && $currentChapter !== null) {
                $currentChapter['content'] = str_replace('Isi Bab:', '', $line);
            }
        }

        return $chapters;
    }
    private function maxCitationNumber(string $html): int
    {
        if ($html === '') return 0;
        preg_match_all('/\[\s*C(\d+)\s*\]/i', $html, $m);
        if (empty($m[1])) return 0;
        return max(array_map('intval', $m[1]));
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
            '/<h3>\d+\.\d+/i',
            '/Tentang\s+Penulis/i',
            '/<h2>\s*Tentang\s+Penulis\s*<\/h2>/i',
            '/Pengantar\s+Penulis/i',      // Mencegah format sub-bab seperti "1.1"
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
