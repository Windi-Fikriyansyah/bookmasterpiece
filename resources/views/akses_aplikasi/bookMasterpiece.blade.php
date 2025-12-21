<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Book Masterpiece AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Merriweather:wght@300;400;700&family=Source+Serif+Pro:wght@300;400;600&display=swap"
        rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&family=Source+Serif+Pro:wght@300;400;600&display=swap"
        rel="stylesheet">
    <style>
        .page-break {
            page-break-after: always;
        }

        .section-container {
            page-break-inside: avoid;
        }

        /* Styling untuk eBook */
        .ebook-content {
            font-family: 'Source Serif Pro', 'Times New Roman', serif;
            font-size: 16px;
            line-height: 1.8;
            color: #333;
        }

        .ebook-content h1 {
            font-family: 'Merriweather', 'Times New Roman', serif;
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-top: 3rem;
            margin-bottom: 1.5rem;
            color: #1a202c;
            border-bottom: 3px double #e2e8f0;
            padding-bottom: 1rem;
        }

        .ebook-content h2 {
            font-family: 'Merriweather', 'Times New Roman', serif;
            font-size: 1.8rem;
            font-weight: 600;
            margin-top: 2.5rem;
            margin-bottom: 1.2rem;
            color: #2d3748;
            padding-left: 0.5rem;
            border-left: 4px solid #4299e1;
        }

        .ebook-content h3 {
            font-family: 'Merriweather', 'Times New Roman', serif;
            font-size: 1.4rem;
            font-weight: 600;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #4a5568;
        }

        .ebook-content p {
            margin-bottom: 1.2rem;
            text-align: justify;
            text-justify: inter-word;
        }

        .ebook-content ol,
        .ebook-content ul {
            margin-left: 2rem;
            margin-bottom: 1.2rem;
        }

        .ebook-content h1+p {
            text-align: center;
            margin-top: -0.5rem;
            margin-bottom: 2rem;
            font-style: italic;
            font-size: 1.1rem;
            color: #4a5568;
        }

        /* Garis (tabline) di bawah tagline */
        .ebook-content h1+p::after {
            content: "";
            display: block;
            width: 60%;
            margin: 1.2rem auto 0;
            border-bottom: 2px solid #e2e8f0;
        }

        .ebook-content li {
            margin-bottom: 0.5rem;
        }

        .ebook-content blockquote {
            font-style: italic;
            margin: 1.5rem 0;
            padding: 1rem 1.5rem;
            background-color: #f7fafc;
            border-left: 4px solid #cbd5e0;
            color: #4a5568;
        }

        .ebook-content .chapter-number {
            font-family: 'Merriweather', 'Times New Roman', serif;
            font-size: 1.2rem;
            font-weight: 300;
            color: #718096;
            margin-bottom: 0.5rem;
        }

        .ebook-content .section-container {
            position: relative;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background-color: white;
            page-break-inside: avoid;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .ebook-content .section-container:hover {
            border-color: #4299e1;
            box-shadow: 0 4px 6px rgba(66, 153, 225, 0.1);
        }

        .ebook-content [contenteditable="true"]:focus {
            outline: none;
            background-color: #f8fafc;
        }

        .ebook-content .action-buttons {
            opacity: 0;
            transition: opacity 0.2s;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px dashed #e2e8f0;
        }

        .ebook-content .section-container:hover .action-buttons,
        .ebook-content .section-container:has([contenteditable="true"]:focus) .action-buttons {
            opacity: 1;
        }

        .ebook-content .chapter-badge {
            position: absolute;
            top: -12px;
            left: 20px;
            background: linear-gradient(135deg, #4299e1, #3182ce);
            color: white;
            padding: 4px 15px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(66, 153, 225, 0.3);
            z-index: 10;
        }

        /* Styling untuk daftar isi */
        .ebook-content .toc-container {
            background: linear-gradient(135deg, #f7fafc, #edf2f7);
            padding: 2rem;
            border-radius: 8px;
            margin: 2rem 0;
        }

        .ebook-content .toc-container h2 {
            text-align: center;
            border-left: none;
            padding-left: 0;
            color: #2d3748;
        }

        .ebook-content .toc-container ol {
            margin-left: 1rem;
            padding-left: 1rem;
        }

        .ebook-content .toc-container li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .ebook-content .toc-container li:last-child {
            border-bottom: none;
        }

        /* Styling untuk placeholder */
        .ebook-placeholder {
            font-family: 'Merriweather', 'Times New Roman', serif;
            text-align: center;
            padding: 4rem 2rem;
            color: #718096;
            background-color: #f8fafc;
            border: 2px dashed #cbd5e0;
            border-radius: 12px;
            margin: 2rem 0;
        }

        .ebook-placeholder h3 {
            font-size: 1.8rem;
            color: #4a5568;
            margin-bottom: 1rem;
        }

        /* Styling untuk summary dan closing */
        .ebook-content .summary-section,
        .ebook-content .closing-section {
            background: linear-gradient(135deg, #f0fff4, #e6fffa);
            padding: 2rem;
            border-radius: 8px;
            margin: 2rem 0;
            border-left: 4px solid #38a169;
        }

        /* Page-like appearance */
        #ebook_content {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
            padding: 3rem;
            min-height: 700px;
            max-height: 900px;
            overflow-y: auto;
            box-shadow:
                0 4px 6px rgba(0, 0, 0, 0.1),
                inset 0 0 40px rgba(0, 0, 0, 0.05);
        }

        @media print {
            .ebook-content {
                font-size: 12pt;
                line-height: 1.6;
            }

            .action-buttons,
            .chapter-badge {
                display: none !important;
            }

            .section-container {
                border: none !important;
                box-shadow: none !important;
                page-break-inside: avoid !important;
            }
        }

        .ebook-img {
            max-width: 100%;
            height: auto;
            cursor: pointer;
            border-radius: 10px;
        }

        /* Toolbar gambar (floating) */
        #img-toolbar {
            position: fixed;
            z-index: 9999;
            display: none;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .12);
        }

        #img-toolbar .tool-btn {
            width: 36px;
            height: 32px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            background: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        #img-toolbar .tool-btn.active {
            background: #2563eb;
            border-color: #2563eb;
            color: #fff;
        }

        #img-toolbar .tool-btn:hover {
            background: #f3f4f6;
        }

        #img-toolbar .tool-btn.active:hover {
            background: #1d4ed8;
        }

        #imgDelete {
            color: #ef4444;
        }

        #imgDelete:hover {
            background: #fee2e2;
        }

        .bm-gear-btn {
            width: 34px;
            height: 32px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            background: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .bm-gear-btn:hover {
            background: #f3f4f6;
        }

        #bm-settings-popover {
            position: fixed;
            z-index: 99999;
            width: 230px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .12);
            padding: 12px;
            display: none;
        }

        #bm-settings-popover label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #374151;
            margin-top: 10px;
            margin-bottom: 6px;
        }

        #bm-settings-popover select {
            width: 100%;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 8px 10px;
            font-size: 14px;
            outline: none;
        }

        #bm-settings-popover .bm-title {
            font-size: 13px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 6px;
        }

        /* ====== Apply formatting per-section via CSS variables ====== */
        /* Set di contenteditable: style="--bm-align:...; --bm-font:...; --bm-lh:..." */

        .section-container [contenteditable="true"] {
            font-family: var(--bm-font, inherit);
            line-height: var(--bm-lh, inherit);
        }

        /* Override default .ebook-content p { text-align: justify } */
        .section-container [contenteditable="true"] p {
            text-align: var(--bm-align, justify) !important;
            text-justify: inter-word;
        }

        .section-container [contenteditable="true"] li {
            text-align: var(--bm-align, justify) !important;
        }

        .section-container [contenteditable="true"] blockquote {
            line-height: var(--bm-lh, inherit);
        }

        .section-container [contenteditable="true"] {
            text-align: var(--bm-align, justify) !important;
        }

        /* Pastikan semua elemen block ikut (judul, div, dsb) */
        .section-container [contenteditable="true"] :is(p, div, li, blockquote, h1, h2, h3, h4, h5, h6) {
            text-align: var(--bm-align, justify) !important;
        }
    </style>
</head>

<body class="bg-[#eef3f8] font-sans">

    <!-- Header -->
    <div class="text-center py-8">
        <h1 class="text-4xl font-bold text-gray-800">Book Masterpiece AI</h1>
        <p class="text-gray-500 mt-2">
            Asisten Menulis Buku Anda yang Siap Terbit
        </p>
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6 pb-10 px-4">

        <!-- SIDEBAR -->
        <div class="space-y-6 lg:col-span-1">

            <!-- Langkah 1 -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h2 class="font-semibold text-lg flex items-center gap-2 text-blue-600">
                    <span class="bg-blue-100 p-2 rounded-lg">🔧</span> Langkah 1: Konfigurasi Book
                </h2>

                <div class="mt-4 space-y-4">

                    <div>
                        <label class="text-sm font-medium block mb-1">Google AI API Key:</label>

                        <div class="relative">
                            <input type="password" id="api_key_input"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 pr-10 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                placeholder="Masukkan API Key Anda di sini">

                            <!-- Tombol mata -->
                            <button type="button" id="toggle_api_key"
                                class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-gray-700">
                                <i id="eye_icon" class="fas fa-eye"></i>
                            </button>
                        </div>

                        <button id="save_api_key"
                            class="mt-3 w-full bg-green-600 text-white py-2 rounded-lg text-sm hover:bg-green-700 transition-colors duration-200">
                            <i class="fas fa-save mr-2"></i>Simpan API Key
                        </button>

                    </div>

                    <div>
                        <label class="text-sm font-medium block mb-1">Masalah (Problem):</label>
                        <textarea rows="4" id="masalah_input"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            placeholder="Contoh: •	Ingin membuka usaha bimbel, tapi tidak punya modal besar
•	Bingung harus mulai dari mana: izin, tempat, murid, kurikulum
•	Takut usaha sepi karena merasa bukan pebisnis
•	Punya kemampuan mengajar, tapi tidak tahu cara menjualnya"></textarea>
                    </div>

                    <div>
                        <label class="text-sm font-medium block mb-1">Kebutuhan (Need):</label>
                        <textarea rows="4" id="kebutuhan_input"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            placeholder="Contoh: •	Panduan langkah demi langkah yang realistis
•	Contoh usaha bimbel yang benar-benar dimulai dari rumah
•	Cara mencari murid pertama tanpa biaya iklan mahal
•	Rasa yakin bahwa orang biasa juga bisa memulai"></textarea>
                    </div>
                    <div>
                        <label class="text-sm font-medium block mb-1">Solusi (Solution):</label>
                        <textarea rows="4" id="solusi_input"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            placeholder="Contoh: •	Model bimbel rumahan tanpa sewa tempat
•	Strategi mulai dari 1–3 murid dulu
•	Cara promosi sederhana (WA grup orang tua, tetangga, kenalan)
•	Sistem belajar sederhana tanpa ribet administrasi
•	Contoh jadwal, materi, dan biaya bimbel pemula"></textarea>
                    </div>
                    <div>
                        <label class="text-sm font-medium block mb-1">Pengalaman (Experience):</label>
                        <textarea rows="4" id="pengalaman_input"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            placeholder="Contoh: •	Model bimbel rumahan tanpa sewa tempat
•	Strategi mulai dari 1–3 murid dulu
•	Cara promosi sederhana (WA grup orang tua, tetangga, kenalan)
•	Sistem belajar sederhana tanpa ribet administrasi
•	Contoh jadwal, materi, dan biaya bimbel pemula"></textarea>
                    </div>
                    <div>
                        <label class="text-sm font-medium block mb-1">Kompetensi (Competence):</label>
                        <textarea rows="4" id="kompetensi_input"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            placeholder="Contoh: •	Lulusan pendidikan / guru honorer
•	Pernah mengajar les privat
•	Pernah mendampingi anak-anak belajar
•	Punya pengalaman mengajar meski informal"></textarea>
                    </div>

                    <div>
                        <label class="text-sm font-medium block mb-1">Calon Pembaca:</label>
                        <textarea rows="4" id="calon_pembaca_input"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            placeholder="Siapa satu orang nyata yang paling ingin saya tolong melalui buku ini? contoh calon pengusaha bimbel pemula dari kalangan guru honorer"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-sm font-medium block mb-1">Gaya Bahasa:</label>
                            <select id="gaya_input"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                <option>Personal & Akrab (Seperti ngobrol dengan teman dekat)</option>
                                <option>Inspiratif & Reflektif (Menyentuh hati dan kesadaran)</option>
                                <option>Edukatif & Praktis (Mengajar tanpa menggurui)</option>
                                <option>Persuasif (Membujuk dengan logika dan emosi)</option>
                                <option>Naratif & Storytelling (Bercerita untuk menyampaikan pesan)</option>
                                <option>Tegas & Provokatif (Menggugah dan mengusik)</option>
                                <option>Profesional & Formal (Resmi, kredibel, berjarak)</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-medium block mb-1">Jumlah Isi Outline Buku:</label>
                            <input id="jumlah_bab_input" type="text" placeholder="contoh : 5 Bab 5 Sub Bab"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-medium block mb-1">Kontrak Kreatif Penulis AI</label>
                        <textarea rows="4" id="kontrak_kreatif_input"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            placeholder="Contoh: AI dalam buku yang akan saya buat, saya ingin Anda menjadi: asisten menulis kreatif - editor buku saya, partner brainstorming ide menulis - jangan pernah menjiplak - gunakan kalimat orisinal dan bebas plagiasi - bantu saya menjaga suara penulis (author voice) - jika ide saya lemah, bantu perkuat - tetap dengan gaya bahasa, tone dan voice saya, dan tulisan tidak generik AI."></textarea>

                    </div>
                    <div>
                        <label class="text-sm font-medium block mb-1">Tentang Penulis (Opsional):</label>
                        <textarea rows="2" id="penulis_input"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            placeholder="Tulis bio singkat Anda di sini."></textarea>
                    </div>
                    {{-- <div>
                        <label class="text-sm font-medium block mb-1">Pengantar Penulis (Opsional):</label>
                        <textarea rows="2" id="pengantar_input"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            placeholder="Tulis satu deskripsi singkat pengantar buku Anda."></textarea>
                    </div> --}}
                </div>
            </div>

            <!-- Langkah 2 -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h2 class="font-semibold text-lg flex items-center gap-2 text-blue-600 mb-4">
                    <span class="bg-blue-100 p-2 rounded-lg">📝</span> Langkah 2: Buat Konten
                </h2>

                <div class="space-y-3">
                    <button onclick="generateEbook('title')"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg text-sm hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center gap-2">
                        <i class="fas fa-heading"></i>
                        Buat Judul Buku
                    </button>
                    <button onclick="generateOutlineFromUserInput()"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg text-sm hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center gap-2">
                        <i class="fas fa-list-ol"></i>
                        Buat Daftar Isi
                    </button>

                    <button onclick="generateEbook('preface')"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg text-sm hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center gap-2">
                        <i class="fas fa-pen-nib"></i>
                        Buat Kata Pengantar
                    </button>
                    <button onclick="generateEbook('intro')"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg text-sm hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center gap-2">
                        <i class="fas fa-book-open"></i>
                        Buat Pendahuluan
                    </button>



                    <!-- TAMBAH tombol ini di bagian Langkah 2, setelah tombol "Buat Pendahuluan" -->


                    <div class="grid grid-cols-2 gap-3 pt-2">
                        <button onclick="addManualSection()"
                            class="w-full bg-green-500 text-white py-3 rounded-lg text-sm hover:bg-green-600 transition-colors duration-200 flex items-center justify-center gap-2">
                            <i class="fas fa-plus"></i>
                            Sisip Manual
                        </button>

                        <button onclick="generateEbook('chapter')"
                            class="w-full bg-indigo-600 text-white py-3 rounded-lg text-sm hover:bg-indigo-700 transition-colors duration-200 flex items-center justify-center gap-2">
                            <i class="fas fa-robot"></i>
                            Buat 1 Bab (AI)
                        </button>
                    </div>

                    <button onclick="generateEbook('summary')"
                        class="w-full bg-gray-700 text-white py-3 rounded-lg text-sm hover:bg-gray-800 transition-colors duration-200 flex items-center justify-center gap-2">
                        <i class="fas fa-file-signature"></i>
                        Buat Ringkasan
                    </button>

                    <button onclick="generateEbook('closing')"
                        class="w-full bg-gray-800 text-white py-3 rounded-lg text-sm hover:bg-gray-900 transition-colors duration-200 flex items-center justify-center gap-2">
                        <i class="fas fa-flag-checkered"></i>
                        Buat Penutup
                    </button>

                    <button onclick="generateDaftarPustaka()"
                        class="w-full bg-gray-800 text-white py-3 rounded-lg text-sm hover:bg-gray-900 transition-colors duration-200 flex items-center justify-center gap-2">
                        <i class="fas fa-book"></i>
                        Buat Daftar Pustaka
                    </button>

                    <button onclick="generateEbook('profilpenulis')"
                        class="w-full bg-gray-800 text-white py-3 rounded-lg text-sm hover:bg-gray-900 transition-colors duration-200 flex items-center justify-center gap-2">
                        <i class="fas fa-user-pen"></i>
                        Buat Profil Penulis
                    </button>


                </div>

                <!-- Tombol Reset & Download -->
                <div class="mt-6 pt-4 border-t border-gray-200 space-y-2">
                    <button onclick="downloadEbook()"
                        class="w-full bg-purple-600 text-white py-3 rounded-lg text-sm hover:bg-purple-700 transition-colors duration-200 flex items-center justify-center gap-2">
                        <i class="fas fa-download mr-2"></i>Download Book (PDF)
                    </button>

                    <button onclick="resetEbook()"
                        class="w-full bg-red-500 text-white py-3 rounded-lg text-sm hover:bg-red-600 transition-colors duration-200 flex items-center justify-center gap-2">
                        <i class="fas fa-trash-alt mr-2"></i>Reset Semua Konten
                    </button>
                </div>
            </div>

        </div>

        <!-- PANEL ISI Book -->
        <div class="lg:col-span-2">
            <div class="bg-white p-4 rounded-xl shadow">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="font-semibold text-lg text-gray-800">
                        <i class="fas fa-book mr-2"></i>Preview Book
                    </h2>
                    <div class="flex gap-2">
                        <button onclick="toggleEbookView()" id="toggleViewBtn"
                            class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300">
                            <i class="fas fa-eye mr-1"></i>Toggle View
                        </button>
                        <button onclick="printEbook()"
                            class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-sm hover:bg-blue-200">
                            <i class="fas fa-print mr-1"></i>Print
                        </button>
                    </div>
                </div>

                <div id="ebook_content" class="ebook-content min-h-[700px] max-h-[900px] overflow-y-auto">

                    <!-- Placeholder -->
                    <div id="ebook_placeholder" class="ebook-placeholder">
                        <div class="text-6xl mb-4 text-blue-300">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h3 class="text-xl font-semibold">Book Anda akan tampil di sini</h3>
                        <p class="text-gray-500 mt-2">Mulai dengan menjelaskan masalah Anda dan klik tombol di panel
                            kiri untuk membuat konten.</p>

                    </div>

                </div>
            </div>

            <!-- Stats -->
            <div class="mt-4 grid grid-cols-4 gap-3">
                <div class="bg-white p-3 rounded-lg shadow text-center">
                    <div class="text-2xl font-bold text-blue-600" id="wordCount">0</div>
                    <div class="text-xs text-gray-500">Kata</div>
                </div>
                <div class="bg-white p-3 rounded-lg shadow text-center">
                    <div class="text-2xl font-bold text-green-600" id="chapterCount">0</div>
                    <div class="text-xs text-gray-500">Bab</div>
                </div>
                <div class="bg-white p-3 rounded-lg shadow text-center">
                    <div class="text-2xl font-bold text-purple-600" id="sectionCount">0</div>
                    <div class="text-xs text-gray-500">Bagian</div>
                </div>
                <div class="bg-white p-3 rounded-lg shadow text-center">
                    <div class="text-2xl font-bold text-orange-600" id="pageCount">0</div>
                    <div class="text-xs text-gray-500">Halaman</div>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <div class="text-center pb-6 text-gray-500 text-sm mt-8">
        <div class="max-w-4xl mx-auto px-4">
            <div class="border-t border-gray-200 pt-4">
                <p>© 2025. Book Masterpiece v4.0 - Enhanced Edition</p>
                <p class="mt-1 text-xs">Dibuat dengan <i class="fas fa-heart text-red-400"></i> untuk para penulis
                    digital</p>
            </div>
        </div>
    </div>

    <div id="ebook_pdf_clone" style="display:none; position: absolute; left: -9999px; width: 800px;"></div>




    <!-- Hidden file input untuk sisip gambar -->
    <input type="file" id="imgInsertInput" accept="image/*" class="hidden" />

    <!-- Toolbar floating untuk gambar -->
    <div id="img-toolbar">
        <div class="flex items-center gap-2">
            <span class="text-xs text-gray-600">Ukuran:</span>
            <input id="imgSizeRange" type="range" min="10" max="100" value="50" class="w-36">
            <span id="imgSizeLabel" class="text-xs font-semibold w-10 text-right">50%</span>
        </div>

        <div class="flex items-center gap-1 border-l pl-2">
            <button id="imgAlignLeft" class="tool-btn" title="Rata kiri">
                <i class="fas fa-align-left"></i>
            </button>
            <button id="imgAlignCenter" class="tool-btn" title="Rata tengah">
                <i class="fas fa-align-center"></i>
            </button>
            <button id="imgAlignRight" class="tool-btn" title="Rata kanan">
                <i class="fas fa-align-right"></i>
            </button>
        </div>
        <div class="flex items-center gap-1 border-l pl-2">
            <button id="imgDelete" class="tool-btn" title="Hapus gambar">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const apiInput = document.getElementById("api_key_input");
            const toggleBtn = document.getElementById("toggle_api_key");
            const eyeIcon = document.getElementById("eye_icon");

            if (toggleBtn) {
                toggleBtn.addEventListener("click", () => {
                    const isPassword = apiInput.type === "password";

                    apiInput.type = isPassword ? "text" : "password";
                    eyeIcon.classList.toggle("fa-eye");
                    eyeIcon.classList.toggle("fa-eye-slash");
                });
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            fetch("/ebook/get-api-key", {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                })
                .then(res => res.json())
                .then(res => {
                    if (res.api_key) {
                        const input = document.getElementById("api_key_input");
                        if (input) {
                            input.value = res.api_key;
                            localStorage.setItem("api_key", res.api_key);
                        }
                    }
                })
                .catch(err => console.error("Gagal load API Key:", err));
        });
        // Inisialisasi state ebook
        let ebookState = {
            title: null,
            preface: null,
            intro: null,
            outline: null,
            chapters: [],
            summary: null,
            closing: null,
            manualSections: [],
            references: [],
            bibliography: null,
            authorProfile: null,
            sectionFormats: {}
        };

        let isGenerating = false;
        let isEbookView = true;

        // Load state dari localStorage saat halaman dimuat
        document.addEventListener("DOMContentLoaded", () => {
            const savedApiKey = localStorage.getItem('api_key');
            if (savedApiKey) {
                document.getElementById("api_key_input").value = savedApiKey;
            }

            loadEbookState();
            loadFormData();
            setupFormAutosave();
            updateStats();

            document.getElementById('save_api_key').addEventListener('click', saveApiKey);
        });

        function saveApiKey() {
            const apiKey = document.getElementById('api_key_input').value.trim();

            if (!apiKey) {
                showToast("API Key tidak boleh kosong", "error");
                return;
            }

            fetch("/save-api-key", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content")
                    },
                    body: JSON.stringify({
                        api_key: apiKey
                    })
                })
                .then(res => res.json())
                .then(res => {
                    if (!res.status) {
                        showToast(res.message, "error");
                        return;
                    }

                    // OPTIONAL: tetap simpan di localStorage untuk UX
                    localStorage.setItem("api_key", apiKey);

                    showToast(res.message, "success");
                })
                .catch(err => {
                    console.error(err);
                    showToast("Gagal menyimpan API Key", "error");
                });
        }


        function setupFormAutosave() {
            const inputs = [
                'masalah_input',
                'kebutuhan_input',
                'solusi_input',
                'pengalaman_input',
                'kompetensi_input',
                'kontrak_kreatif_input',
                'calon_pembaca_input',
                'gaya_input',
                'jumlah_bab_input',
                'penulis_input',
                'pengantar_input'
            ];

            inputs.forEach(inputId => {
                const el = document.getElementById(inputId);
                if (!el) return;

                el.addEventListener('input', () => {
                    saveFormData();
                    updateStats();
                });
                el.addEventListener('change', () => {
                    saveFormData();
                    updateStats();
                });
            });
        }


        function saveFormData() {
            const formData = {
                masalah: safeVal("masalah_input"),
                kebutuhan: safeVal("kebutuhan_input"),
                solusi: safeVal("solusi_input"),
                pengalaman: safeVal("pengalaman_input"),
                kompetensi: safeVal("kompetensi_input"),
                kontrak_kreatif: safeVal("kontrak_kreatif_input"),
                calon_pembaca: safeVal("calon_pembaca_input"),
                gaya: safeVal("gaya_input"),
                jumlah_outline: safeVal("jumlah_bab_input"),
                tentang_penulis: safeVal("penulis_input"),
                pengantar_penulis: safeVal("pengantar_input")
            };

            localStorage.setItem('ebook_form_data', JSON.stringify(formData));
        }


        function loadFormData() {
            const saved = localStorage.getItem('ebook_form_data');
            if (!saved) return;

            const d = JSON.parse(saved);

            safeSetVal("masalah_input", d.masalah || '');
            safeSetVal("kebutuhan_input", d.kebutuhan || '');
            safeSetVal("solusi_input", d.solusi || '');
            safeSetVal("pengalaman_input", d.pengalaman || '');
            safeSetVal("kompetensi_input", d.kompetensi || '');
            safeSetVal("kontrak_kreatif_input", d.kontrak_kreatif || '');
            safeSetVal("calon_pembaca_input", d.calon_pembaca || '');

            safeSetVal("gaya_input", d.gaya || 'Edukatif & Praktis (Mengajar tanpa menggurui)');
            safeSetVal("jumlah_bab_input", d.jumlah_outline || '');
            safeSetVal("penulis_input", d.tentang_penulis || '');
            safeSetVal("pengantar_input", d.pengantar_penulis || '');
        }

        function loadEbookState() {
            const savedState = localStorage.getItem('ebook_state');
            if (savedState) {
                ebookState = JSON.parse(savedState);

                if (!ebookState.sectionFormats) ebookState.sectionFormats = {};

                // FIX: jika daftar chapter tidak cocok dengan tampilan, reset
                if (!ebookState.chapters || ebookState.chapters.length === 0) {
                    ebookState.chapters = [];
                }

                rebuildReferencesFromAllChapters();
                saveEbookState();
                renderEbookContent();
                updateStats();
            }
        }

        function saveEbookState() {
            localStorage.setItem('ebook_state', JSON.stringify(ebookState));
            updateStats();
        }

        function updateStats() {
            // Hitung jumlah kata
            let totalWords = 0;

            const sections = [
                ebookState.title,
                ebookState.preface,
                ebookState.intro,
                ebookState.outline,
                ebookState.summary,
                ebookState.closing,
                ebookState.bibliography,
                ebookState.authorProfile,
                ...ebookState.chapters.map(c => c.content),
                ...ebookState.manualSections.map(s => s.content)
            ];

            sections.forEach(content => {
                if (content) {
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = content;
                    const text = tempDiv.textContent || tempDiv.innerText || '';
                    const words = text.split(/\s+/).filter(word => word.length > 0);
                    totalWords += words.length;
                }
            });

            document.getElementById('wordCount').textContent = totalWords.toLocaleString();
            document.getElementById('chapterCount').textContent = ebookState.chapters.length;
            document.getElementById('sectionCount').textContent =
                sections.filter(c => c).length + ebookState.manualSections.length;

            // Estimasi halaman (rata-rata 250 kata per halaman)
            const estimatedPages = Math.max(1, Math.ceil(totalWords / 250));
            document.getElementById('pageCount').textContent = estimatedPages;
        }

        function addManualSection() {
            const sectionId = 'manual_' + Date.now();
            const newSection = {
                id: sectionId,
                content: `
                    <h2>Bagian Manual</h2>
                    <p>Bagian ini dapat Anda edit sesuai kebutuhan. Klik pada teks untuk mulai mengedit.</p>
                    <p>Gunakan bagian ini untuk menambahkan konten tambahan, contoh, studi kasus, atau informasi lain yang relevan.</p>
                    <blockquote>
                        <p>Tips: Gunakan format yang konsisten dengan bagian lainnya untuk menjaga profesionalitas book.</p>
                    </blockquote>
                `,
                type: 'manual',
                order: Date.now()
            };

            ebookState.manualSections.push(newSection);
            saveEbookState();
            renderEbookContent();

            showToast("Bagian manual berhasil ditambahkan", "success");
        }

        function safeVal(id) {
            const el = document.getElementById(id);
            return el ? (el.value ?? '') : '';
        }

        function safeSetVal(id, value) {
            const el = document.getElementById(id);
            if (el) el.value = value ?? '';
        }


        function getFormValues() {
            return {
                masalah: safeVal("masalah_input"),
                kebutuhan: safeVal("kebutuhan_input"),
                solusi: safeVal("solusi_input"),
                pengalaman: safeVal("pengalaman_input"),
                kompetensi: safeVal("kompetensi_input"),
                kontrak_kreatif: safeVal("kontrak_kreatif_input"),
                calon_pembaca: safeVal("calon_pembaca_input"),
                gaya: safeVal("gaya_input"),
                jumlah_outline: safeVal("jumlah_bab_input"),
                tentang_penulis: safeVal("penulis_input"),
                pengantar_penulis: safeVal("pengantar_input")
            };
        }


        function extractChapterTitles() {
            const titles = [];

            if (ebookState.outline) {
                const temp = document.createElement('div');
                temp.innerHTML = ebookState.outline;

                // Cari semua bab
                temp.querySelectorAll('li').forEach(li => {
                    const text = li.textContent.trim();
                    const match = text.match(/Bab\s+\d+:\s*(.+?)(?:\s*\d+\.\d+|$)/i);
                    if (match) {
                        titles.push(match[1].trim());
                    }
                });
            }

            // Gabungkan dengan bab yang sudah dibuat
            ebookState.chapters.forEach(ch => {
                if (ch.title && !titles.includes(ch.title)) {
                    titles.push(ch.title);
                }
            });

            return titles;
        }

        function getChapterTitles() {
            return ebookState.chapters.map(chapter => {
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = chapter.content;
                const h2 = tempDiv.querySelector('h2');
                if (h2) {
                    const text = h2.textContent || h2.innerText;
                    const match = text.match(/Bab\s+\d+:\s*(.+)/i);
                    return match ? match[1].trim() : `Judul Bab ${chapter.chapterNumber}`;
                }
                return `Judul Bab ${chapter.chapterNumber}`;
            });
        }

        async function updateOutline() {
            const val = getFormValues();
            const apiKey = document.getElementById("api_key_input").value.trim();
            if (!apiKey) return showToast("API Key belum disimpan.", "error");

            // Ambil daftar bab dari konten
            const existingChapters = ebookState.chapters.map((ch, i) => ({
                number: i + 1,
                title: ch.title
            }));

            // Ambil judul dari daftar isi lama
            const currentOutline = extractOutlineTitles();

            // Gabungkan cek → tidak boleh menambah bab duplikat
            let finalOutline = [];

            existingChapters.forEach(ch => {
                const exist = currentOutline.find(o => o.number === ch.number);
                if (!exist) {
                    // Jika bab belum ada dalam daftar isi → tambahkan
                    finalOutline.push(ch);
                } else {
                    // Jika sudah ada → pakai yang lama
                    finalOutline.push(exist);
                }
            });

            // Buat ulang daftar isi
            let html = `<h2>Daftar Isi</h2><ol>`;
            finalOutline.forEach(ch => {
                html += `<li>Bab ${ch.number}: ${ch.title}</li>`;
            });
            html += `</ol>`;

            ebookState.outline = html;
            saveEbookState();
            renderEbookContent();

            showToast("Daftar isi diperbarui", "success");
        }



        async function generateEbook(action) {
            if (isGenerating) {
                showToast("Sedang membuat konten, mohon tunggu...", "warning");
                return;
            }

            const val = getFormValues();

            // Hanya untuk action selain 'title', cek masalah harus diisi
            if (action !== 'title' && !val.masalah.trim()) {
                showToast("Masalah harus diisi dulu.", "error");
                return;
            }

            const apiKey = document.getElementById("api_key_input").value.trim();
            if (!apiKey) {
                showToast("API Key belum disimpan.", "error");
                return;
            }

            isGenerating = true;
            let placeholder = document.getElementById("ebook_placeholder");
            if (placeholder) placeholder.style.display = "none";

            showLoadingIndicator(action);

            try {
                // JIKA ACTION TITLE - buat judul saja
                if (action === "title") {
                    const response = await fetch("/ebook/generate", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            action: action,
                            masalah: val.masalah,
                            kebutuhan: val.kebutuhan,
                            pengalaman: val.pengalaman,
                            solusi: val.solusi,
                            kompetensi: val.kompetensi,
                            kontrak_kreatif: val.kontrak_kreatif,
                            calon_pembaca: val.calon_pembaca,
                            gaya: val.gaya,
                            jumlah_outline: val.jumlah_outline,
                            tentang_penulis: val.tentang_penulis,
                            pengantar_penulis: val.pengantar_penulis,
                            existing_title: "",
                            current_chapter_count: 0,
                            chapter_titles: [],
                            target_chapter: null
                        })
                    });

                    const result = await response.json();

                    if (!result.status) {
                        showToast(result.message, "error");
                        return;
                    }

                    // Simpan hanya judul
                    ebookState.title = result.html;
                    ebookState.preface = null;
                    ebookState.intro = null; // Reset intro agar bisa dibuat lagi
                    ebookState.outline = null; // Reset outline

                    saveEbookState();
                    renderEbookContent();
                    showToast("Judul book berhasil dibuat!", "success");

                    // Tampilkan dialog konfirmasi untuk lanjut ke pendahuluan
                    // setTimeout(() => {
                    //     if (confirm(
                    //             "Judul book berhasil dibuat! Apakah Anda ingin melanjutkan membuat Pendahuluan?"
                    //         )) {
                    //         generateEbook('intro');
                    //     }
                    // }, 500);

                    return;
                }

                // JIKA ACTION PREFACE - buat kata pengantar
                if (action === "preface") {
                    if (!ebookState.title) {
                        showToast("Buat judul book terlebih dahulu!", "error");
                        return;
                    }

                    const currentChapterCount = ebookState.chapters.length;
                    const chapterTitles = extractChapterTitles();

                    const response = await fetch("/ebook/generate", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            action: action,
                            masalah: val.masalah,
                            kebutuhan: val.kebutuhan,
                            solusi: val.solusi,
                            pengalaman: val.pengalaman,
                            kompetensi: val.kompetensi,
                            kontrak_kreatif: val.kontrak_kreatif,
                            calon_pembaca: val.calon_pembaca,
                            gaya: val.gaya,
                            jumlah_outline: val.jumlah_outline,
                            tentang_penulis: val.tentang_penulis,
                            pengantar_penulis: val.pengantar_penulis,
                            existing_title: ebookState.title || "",
                            current_chapter_count: currentChapterCount,
                            chapter_titles: chapterTitles,
                            target_chapter: null
                        })
                    });

                    const result = await response.json();
                    if (!result.status) {
                        showToast(result.message, "error");
                        return;
                    }

                    ebookState.preface = result.html;
                    saveEbookState();
                    renderEbookContent();
                    showToast("Kata Pengantar berhasil dibuat!", "success");
                    return;
                }


                // JIKA ACTION INTRO - dan judul sudah ada, buat pendahuluan
                if (action === "intro") {
                    if (!ebookState.title) {
                        showToast("Buat judul book terlebih dahulu!", "error");
                        return;
                    }

                    const currentChapterCount = ebookState.chapters.length;
                    const chapterTitles = extractChapterTitles();

                    const response = await fetch("/ebook/generate", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            action: action,
                            masalah: val.masalah,
                            kebutuhan: val.kebutuhan,
                            solusi: val.solusi,
                            pengalaman: val.pengalaman,
                            kompetensi: val.kompetensi,
                            kontrak_kreatif: val.kontrak_kreatif,
                            calon_pembaca: val.calon_pembaca,
                            gaya: val.gaya,
                            jumlah_outline: val.jumlah_outline,
                            tentang_penulis: val.tentang_penulis,
                            pengantar_penulis: val.pengantar_penulis,
                            existing_title: ebookState.title || "",
                            current_chapter_count: currentChapterCount,
                            chapter_titles: chapterTitles,
                            target_chapter: null
                        })
                    });

                    const result = await response.json();

                    if (!result.status) {
                        showToast(result.message, "error");
                        return;
                    }

                    // Simpan pendahuluan
                    ebookState.intro = result.html;

                    saveEbookState();
                    renderEbookContent();
                    showToast("Pendahuluan berhasil dibuat!", "success");

                    // Tampilkan dialog konfirmasi untuk lanjut ke daftar isi
                    // setTimeout(() => {
                    //     if (confirm(
                    //             "Pendahuluan berhasil dibuat! Apakah Anda ingin melanjutkan membuat Daftar Isi?"
                    //         )) {
                    //         generateOutlineFromUserInput();
                    //     }
                    // }, 500);

                    return;
                }

                // JIKA ACTION LAINNYA (termasuk chapter)
                const currentChapterCount = ebookState.chapters.length;
                const chapterTitles = extractChapterTitles();
                const nextChapterNumber = currentChapterCount + 1;

                if (action === "chapter") {
                    // Ambil struktur lengkap dari daftar isi
                    const outlineTitles = extractChapterTitlesFromOutline();
                    const nextChapterNumber = currentChapterCount + 1;

                    // Cari data bab yang akan dibuat
                    const tocItem = outlineTitles.find(item => item.number === nextChapterNumber);

                    let subBabTitles = [];
                    let chapterTitleFromTOC = '';

                    if (tocItem) {
                        chapterTitleFromTOC = tocItem.title;
                        subBabTitles = tocItem.subBabs || [];

                        console.log(`📖 Membuat Bab ${nextChapterNumber}: ${chapterTitleFromTOC}`);
                        console.log('📑 Sub-bab yang harus dibuat:', subBabTitles);
                    } else {
                        console.warn(`⚠️ Bab ${nextChapterNumber} tidak ditemukan di daftar isi`);
                    }

                    // Validasi: pastikan ada sub-bab
                    if (subBabTitles.length === 0) {
                        showToast(
                            `Peringatan: Bab ${nextChapterNumber} tidak memiliki sub-bab di daftar isi. Pastikan daftar isi sudah dibuat dengan benar.`,
                            "warning");
                    }

                    const response = await fetch("/ebook/generate", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            action: action,
                            masalah: val.masalah,
                            kebutuhan: val.kebutuhan,
                            pengalaman: val.pengalaman,
                            solusi: val.solusi,
                            kompetensi: val.kompetensi,
                            kontrak_kreatif: val.kontrak_kreatif,
                            calon_pembaca: val.calon_pembaca,
                            gaya: val.gaya,
                            jumlah_outline: val.jumlah_outline,
                            tentang_penulis: val.tentang_penulis,
                            pengantar_penulis: val.pengantar_penulis,
                            existing_title: ebookState.title || "",
                            current_chapter_count: currentChapterCount,
                            chapter_titles: extractChapterTitles(),
                            target_chapter: nextChapterNumber,
                            chapter_title_from_toc: chapterTitleFromTOC, // ✅ Tambahkan ini
                            sub_bab_titles: subBabTitles // ✅ Data sub-bab lengkap
                        })
                    });

                    const result = await response.json();

                    if (!result.status) {
                        showToast(result.message, "error");
                        return;
                    }
                    const extracted = extractReferencesFromChapterHtml(result.html);

                    // simpan referensi global
                    ebookState.references = mergeUniqueRefs(ebookState.references || [], extracted.refs);

                    // pakai konten bab yang sudah “bersih” (tanpa blok referensi bab auto)
                    const cleanedChapterHtml = extracted.cleanHtml;

                    // Ekstrak judul bab dari konten
                    const tempDiv = document.createElement("div");
                    tempDiv.innerHTML = result.html;
                    const h2 = tempDiv.querySelector("h2");
                    let chapterTitle = `Bab ${nextChapterNumber}`;

                    if (h2) {
                        const text = h2.textContent.trim();
                        const match = text.match(/Bab\s+\d+:\s*(.+)/i);
                        if (match && match[1]) {
                            chapterTitle = match[1].trim();
                        }
                    }

                    // Buat objek bab baru
                    const newChapter = {
                        id: "chapter_" + Date.now(),
                        content: cleanedChapterHtml,
                        type: "chapter",
                        chapterNumber: nextChapterNumber,
                        title: chapterTitle
                    };

                    // Tambahkan ke array chapters
                    ebookState.chapters.push(newChapter);

                    // Update daftar isi
                    await updateOutlineAfterChapterChange();

                    saveEbookState();
                    renderEbookContent();

                    showToast(`Bab ${nextChapterNumber}: ${chapterTitle} berhasil dibuat!`, "success");
                    return;
                }

                // Untuk action lainnya (outline, summary, closing)
                const aboutAuthor = (action === 'closing') ? '' : val.tentang_penulis;
                const pengantarAuthor = (action === 'closing') ? '' : val.pengantar_penulis;
                const response = await fetch("/ebook/generate", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },


                    body: JSON.stringify({
                        action: action,
                        masalah: val.masalah,
                        kebutuhan: val.kebutuhan,
                        solusi: val.solusi,
                        pengalaman: val.pengalaman,
                        kompetensi: val.kompetensi,
                        kontrak_kreatif: val.kontrak_kreatif,
                        calon_pembaca: val.calon_pembaca,
                        gaya: val.gaya,
                        jumlah_outline: val.jumlah_outline,
                        tentang_penulis: aboutAuthor,
                        pengantar_penulis: pengantarAuthor,
                        dont_write_author_section: (action === 'closing'),
                        existing_title: ebookState.title || "",
                        current_chapter_count: currentChapterCount,
                        chapter_titles: chapterTitles,
                        target_chapter: action === 'chapter' ? nextChapterNumber : null
                    })
                });

                const result = await response.json();

                if (!result.status) {
                    showToast(result.message, "error");
                    return;
                }

                updateEbookState(action, result.html);
                saveEbookState();
                renderEbookContent();
                showToast(`${getActionName(action)} berhasil dibuat!`, "success");

            } catch (e) {
                console.error("Error:", e);
                showToast("Error API: " + e.message, "error");
            } finally {
                isGenerating = false;
                removeLoadingIndicator();
            }
        }

        async function generateOutlineFromUserInput() {
            const val = getFormValues();
            const apiKey = document.getElementById("api_key_input").value.trim();

            if (!apiKey) {
                showToast("API Key belum disimpan.", "error");
                return;
            }

            if (!val.jumlah_outline.trim()) {
                showToast("Jumlah Isi Outline Buku harus diisi terlebih dahulu!", "error");
                return;
            }

            isGenerating = true;
            showLoadingIndicator("outline");

            try {
                const response = await fetch("/ebook/generate", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        action: "outline",
                        masalah: val.masalah,
                        kebutuhan: val.kebutuhan,
                        solusi: val.solusi,
                        pengalaman: val.pengalaman,
                        kompetensi: val.kompetensi,
                        kontrak_kreatif: val.kontrak_kreatif,
                        calon_pembaca: val.calon_pembaca,
                        gaya: val.gaya,
                        jumlah_outline: val.jumlah_outline,
                        tentang_penulis: val.tentang_penulis,
                        pengantar_penulis: val.pengantar_penulis,
                        existing_title: ebookState.title || "",
                        current_chapter_count: 0,
                        chapter_titles: [],
                        target_chapter: null
                    })
                });

                const result = await response.json();

                if (!result.status) {
                    showToast(result.message, "error");
                    return;
                }

                // Simpan daftar isi
                ebookState.outline = result.html;

                saveEbookState();
                renderEbookContent();
                showToast("Daftar isi berhasil dibuat sesuai dengan jumlah yang diinput!", "success");

            } catch (e) {
                console.error("Error:", e);
                showToast("Error membuat daftar isi: " + e.message, "error");
            } finally {
                isGenerating = false;
                removeLoadingIndicator();
            }
        }

        function parseOutlineInput() {
            const input = document.getElementById("jumlah_bab_input").value.trim();
            if (!input) return {
                bab: 5,
                subBab: 5
            };

            // Cari pola seperti "5 Bab 5 Sub Bab" atau "3 Bab 4 Sub"
            const matches = input.match(/(\d+)\s*(?:bab|bab)?\s*(\d+)?/i);

            if (matches) {
                const bab = parseInt(matches[1]) || 5;
                const subBab = matches[2] ? parseInt(matches[2]) : 5;
                return {
                    bab,
                    subBab
                };
            }

            return {
                bab: 5,
                subBab: 5
            };
        }

        function getNextChapterNumber() {
            return ebookState.chapters.length + 1;
        }

        function extractChapterTitlesFromOutline() {
            if (!ebookState.outline) return [];

            const chapters = [];
            const temp = document.createElement('div');
            temp.innerHTML = ebookState.outline;

            // Cari semua elemen li level pertama (bab utama)
            const mainList = temp.querySelector('ol');
            if (!mainList) return chapters;

            const mainItems = mainList.children; // Ambil direct children saja

            Array.from(mainItems).forEach(item => {
                if (item.tagName !== 'LI') return;

                const text = item.firstChild?.textContent?.trim() || '';

                // Cari pola "Bab X: Judul"
                const chapterMatch = text.match(/Bab\s+(\d+):\s*(.+)/i);
                if (chapterMatch) {
                    const chapterNum = parseInt(chapterMatch[1]);
                    let title = chapterMatch[2].trim();

                    // Ekstrak sub-bab dari <ul> di dalam <li> ini
                    const subBabList = item.querySelector('ul');
                    const subBabs = [];

                    if (subBabList) {
                        const subBabItems = subBabList.querySelectorAll('li');
                        subBabItems.forEach(subItem => {
                            const subText = subItem.textContent.trim();
                            // Format bisa: "1.1 Judul" atau "1.1. Judul"
                            const subMatch = subText.match(/(\d+\.\d+)\.?\s+(.+)/);
                            if (subMatch) {
                                subBabs.push({
                                    number: subMatch[1],
                                    title: subMatch[2].trim()
                                });
                            }
                        });
                    }

                    chapters.push({
                        number: chapterNum,
                        title: title,
                        subBabs: subBabs
                    });
                }
            });

            console.log('📋 Ekstraksi dari daftar isi:', chapters); // Debug log
            return chapters;
        }

        function updateOutlineAfterChapterChange() {
            // Urutkan bab berdasarkan nomor
            ebookState.chapters.sort((a, b) => a.chapterNumber - b.chapterNumber);

            // Ambil spesifikasi dari input user
            const outlineSpec = parseOutlineInput();
            const totalBabRequested = outlineSpec.bab;
            const subBabPerBab = outlineSpec.subBab;

            // Jika ada daftar isi yang dibuat user, gunakan itu
            if (ebookState.outline) {
                // Ekstrak judul dari daftar isi yang ada
                const outlineTitles = extractChapterTitlesFromOutline();

                // Update judul bab berdasarkan daftar isi
                outlineTitles.forEach(outlineTitle => {
                    const chapter = ebookState.chapters.find(ch => ch.chapterNumber === outlineTitle.number);
                    if (chapter && outlineTitle.title) {
                        chapter.title = outlineTitle.title;
                    }
                });
            }

            // Update bab-bab yang ada
            ebookState.chapters.forEach((chapter, index) => {
                const chapterNum = index + 1;

                // Update chapterNumber jika perlu
                chapter.chapterNumber = chapterNum;

                // Update konten dengan nomor bab yang benar
                if (chapter.content) {
                    const temp = document.createElement('div');
                    temp.innerHTML = chapter.content;
                    const h2 = temp.querySelector('h2');
                    if (h2) {
                        const currentTitle = chapter.title || `Judul Bab ${chapterNum}`;
                        h2.textContent = `Bab ${chapterNum}: ${currentTitle}`;
                        chapter.content = temp.innerHTML;
                    }
                }
            });

            saveEbookState();
        }


        function getChapterTitleFor(number) {
            const toc = extractOutlineTitles();
            const found = toc.find(t => t.number === number);
            if (found) return found.title;

            // tidak ada di daftar isi → bab baru (AI bebas memberi judul)
            return null;
        }



        function getActionName(action) {
            const names = {
                'title': 'Judul',
                'preface': 'Kata Pengantar',
                'intro': 'Pendahuluan',
                'outline': 'Daftar isi',
                'summary': 'Ringkasan',
                'closing': 'Penutup',
                'profilpenulis': 'Profil Penulis'
            };
            return names[action] || 'Konten';
        }

        function updateEbookState(action, html) {
            switch (action) {
                case 'title':
                    ebookState.title = html;
                    break;
                case 'preface':
                    ebookState.preface = html;
                    break;
                case 'intro':
                    ebookState.intro = html;
                    break;
                case 'outline':
                    ebookState.outline = html;
                    break;
                case 'summary':
                    ebookState.summary = html;
                    break;
                case 'closing':
                    ebookState.closing = sanitizeClosingHtml(html);
                    break;
                case 'profilpenulis':
                    ebookState.authorProfile = html;
                    break;
            }

        }

        function createPlaceholder() {
            const div = document.createElement("div");
            div.id = "ebook_placeholder";
            div.className = "ebook-placeholder";
            div.innerHTML = `
        <div class="text-6xl mb-4 text-blue-300">
            <i class="fas fa-book-open"></i>
        </div>
        <h3 class="text-xl font-semibold">Book Anda akan tampil di sini</h3>
        <p class="text-gray-500 mt-2">
            Mulai dengan menjelaskan masalah Anda dan klik tombol di panel kiri untuk membuat konten.
        </p>

    `;
            return div;
        }


        function extractOutlineTitles() {
            if (!ebookState.outline) return [];

            const temp = document.createElement("div");
            temp.innerHTML = ebookState.outline;

            const li = temp.querySelectorAll("li");
            let titles = [];

            li.forEach(item => {
                const text = item.textContent.trim();
                const match = text.match(/Bab\s+(\d+):\s*(.*)/i);
                if (match) {
                    titles.push({
                        number: parseInt(match[1]),
                        title: match[2]
                    });
                }
            });

            return titles;
        }


        function renderEbookContent() {
            const contentEl = document.getElementById("ebook_content");
            let placeholder = document.getElementById("ebook_placeholder");

            const isEmpty = !ebookState.title &&
                !ebookState.preface &&
                !ebookState.intro &&
                !ebookState.outline &&
                ebookState.chapters.length === 0 &&
                !ebookState.summary &&
                !ebookState.closing &&
                ebookState.manualSections.length === 0;

            if (isEmpty) {
                contentEl.innerHTML = "";
                if (!placeholder) {
                    placeholder = createPlaceholder();
                }
                contentEl.appendChild(placeholder);
                updateStats();
                return;
            }

            // Jika ada konten → sembunyikan placeholder
            if (placeholder) placeholder.style.display = "none";

            let html = "";

            // Render judul jika ada
            if (ebookState.title) {
                html += `
        <div class="section-container" data-type="title">
            ${addActionButtons('title', null)}
            <div contenteditable="true" ${bmStyleAttr('title', null)} onfocus="showActions(this)" onblur="saveEditedSection('title', this.innerHTML)"
                 class="outline-none cursor-text">
                ${ebookState.title}
            </div>
        </div>`;
            }

            // Render daftar isi jika ada - INI YANG PENTING
            if (ebookState.outline) {
                html += `
        <div class="section-container toc-container" data-type="outline">
            ${addActionButtons('outline', null)}
            <div contenteditable="true" ${bmStyleAttr('outline', null)} onfocus="showActions(this)" onblur="saveEditedSection('outline', this.innerHTML)"
                 class="outline-none cursor-text">
                ${ebookState.outline}
            </div>
        </div>`;
            }
            // Render kata pengantar jika ada
            if (ebookState.preface) {
                html += `
    <div class="section-container" data-type="preface">
        ${addActionButtons('preface', null)}
        <div contenteditable="true" ${bmStyleAttr('preface', null)} onfocus="showActions(this)" onblur="saveEditedSection('preface', this.innerHTML)"
            class="outline-none cursor-text">
            ${ebookState.preface}
        </div>
    </div>`;
            }


            // Render pendahuluan jika ada
            if (ebookState.intro) {
                html += `
        <div class="section-container" data-type="intro">
            ${addActionButtons('intro', null)}
            <div contenteditable="true" ${bmStyleAttr('intro', null)} onfocus="showActions(this)" onblur="saveEditedSection('intro', this.innerHTML)"
                 class="outline-none cursor-text">
                ${ebookState.intro}
            </div>
        </div>`;
            }



            // Render bab-bab dengan nomor yang benar
            ebookState.chapters.forEach((chapter, index) => {
                const chapterNum = chapter.chapterNumber || (index + 1);
                const chapterTitle = chapter.title || `Bab ${chapterNum}`;

                html += `
        <div class="section-container" data-id="${chapter.id}" data-type="chapter">
            <div class="chapter-badge">Bab ${chapterNum}: ${chapterTitle}</div>
            ${addActionButtons('chapter', chapter.id)}
            <div contenteditable="true" ${bmStyleAttr('chapter', chapter.id)} onfocus="showActions(this)"
                 onblur="saveEditedSection('chapter', this.innerHTML, '${chapter.id}')"
                 class="outline-none cursor-text">
                ${chapter.content}
            </div>
        </div>`;
            });

            // Render bagian manual
            ebookState.manualSections.forEach((section, index) => {
                html += `
        <div class="section-container" data-id="${section.id}" data-type="manual">
            ${addActionButtons('manual', section.id)}
            <div contenteditable="true" ${bmStyleAttr('manual', section.id)} onfocus="showActions(this)"
                 onblur="saveManualSection('${section.id}', this.innerHTML)"
                 class="outline-none cursor-text">
                ${section.content}
            </div>
        </div>`;
            });

            // Render ringkasan jika ada
            if (ebookState.summary) {
                html += `
        <div class="section-container summary-section" data-type="summary">
            ${addActionButtons('summary', null)}
            <div contenteditable="true" ${bmStyleAttr('summary', null)} onfocus="showActions(this)" onblur="saveEditedSection('summary', this.innerHTML)"
                 class="outline-none cursor-text">
                ${ebookState.summary}
            </div>
        </div>`;
            }

            // Render penutup jika ada
            if (ebookState.closing) {
                html += `
        <div class="section-container closing-section" data-type="closing">
            ${addActionButtons('closing', null)}
            <div contenteditable="true" ${bmStyleAttr('closing', null)} onfocus="showActions(this)" onblur="saveEditedSection('closing', this.innerHTML)"
                 class="outline-none cursor-text">
                ${ebookState.closing}
            </div>
        </div>`;
            }

            if (ebookState.bibliography) {
                html += `
    <div class="section-container" data-type="bibliography">
      ${addActionButtons('bibliography', null)}
      <div contenteditable="true" ${bmStyleAttr('bibliography', null)}
           onfocus="showActions(this)"
           onblur="saveEditedSection('bibliography', this.innerHTML)"
           class="outline-none cursor-text">
        ${ebookState.bibliography}
      </div>
    </div>
  `;
            }

            // Render profil penulis jika ada
            if (ebookState.authorProfile) {
                html += `
        <div class="section-container" data-type="profilpenulis">
            ${addActionButtons('profilpenulis', null)}
            <div contenteditable="true" ${bmStyleAttr('profilpenulis', null)}
                 onfocus="showActions(this)"
                 onblur="saveEditedSection('profilpenulis', this.innerHTML)"
                 class="outline-none cursor-text">
                ${ebookState.authorProfile}
            </div>
        </div>`;
            }



            contentEl.innerHTML = html;
            initImageToolsOnce();
            updateStats(); // Update stats setelah render
        }

        function showActions(element) {
            const container = element.closest('.section-container');
            if (container) {
                const actionButtons = container.querySelector('.action-buttons');
                if (actionButtons) {
                    actionButtons.style.opacity = '1';
                }
            }
        }

        function addActionButtons(type, id) {
            let buttons = '';


            if (type === 'intro') {
                buttons += `
    <button onclick="openContinueIntroModal()"
            class="px-3 py-1 bg-teal-600 text-white rounded text-sm hover:bg-teal-700 transition-colors duration-200">
      <i class="fas fa-forward mr-1"></i> Perpanjang
    </button>
  `;
            }

            if (type === 'preface') {
                buttons += `
    <button onclick="continuePreface()"
            class="px-3 py-1 bg-emerald-600 text-white rounded text-sm hover:bg-emerald-700 transition-colors duration-200">
      <i class="fas fa-forward mr-1"></i> Perpanjang
    </button>
  `;
            }

            if (type === 'summary') {
                buttons += `
    <button onclick="continueSummary()"
            class="px-3 py-1 bg-emerald-600 text-white rounded text-sm hover:bg-emerald-700 transition-colors duration-200">
      <i class="fas fa-forward mr-1"></i> Perpanjang
    </button>
  `;
            }

            if (type === 'closing') {
                buttons += `
    <button onclick="continueClosing()"
            class="px-3 py-1 bg-emerald-600 text-white rounded text-sm hover:bg-emerald-700 transition-colors duration-200">
      <i class="fas fa-forward mr-1"></i> Perpanjang
    </button>
  `;
            }


            if (type === 'chapter') {
                buttons += `
        <button onclick="insertChapterAfter('${id}')"
                class="px-3 py-1 bg-purple-500 text-white rounded text-sm hover:bg-purple-600 transition-colors duration-200">
            <i class="fas fa-plus mr-1"></i> Sisipkan Bab
        </button>
        <button onclick="insertImageToSection('chapter','${id}')"
        class="px-3 py-1 bg-amber-500 text-white rounded text-sm hover:bg-amber-600 transition-colors duration-200">
  <i class="fas fa-image mr-1"></i> Sisip Gambar
</button>


        <button onclick="continueChapter('${id}')"
                class="px-3 py-1 bg-emerald-600 text-white rounded text-sm hover:bg-emerald-700 transition-colors duration-200">
            <i class="fas fa-forward mr-1"></i> Perpanjang Bab
        </button>

        <button onclick="openContinueSubBabModal('${id}')"
                class="px-3 py-1 bg-teal-600 text-white rounded text-sm hover:bg-teal-700 transition-colors duration-200">
            <i class="fas fa-layer-group mr-1"></i> Perpanjang Sub-bab
        </button>
    `;
            }


            // if (type !== 'manual') {
            //     buttons += `
        //     <button onclick="regenerateSection('${type}', '${id}')"
        //             class="px-3 py-1 bg-blue-500 text-white rounded text-sm hover:bg-blue-600 transition-colors duration-200">
        //         <i class="fas fa-sync-alt mr-1"></i> Regenerate
        //     </button>
        //     `;
            // }

            if (type === 'outline') {
                buttons += `
      <button onclick="openExtendOutlineModal()"
              class="px-3 py-1 bg-indigo-600 text-white rounded text-sm hover:bg-indigo-700 transition-colors duration-200">
        <i class="fas fa-plus mr-1"></i> Perpanjang Daftar Isi
      </button>
    `;
            }

            if (type !== 'manual' && type !== 'bibliography') {
                buttons += `
      <button onclick="regenerateSection('${type}', '${id}')"
              class="px-3 py-1 bg-blue-500 text-white rounded text-sm hover:bg-blue-600 transition-colors duration-200">
        <i class="fas fa-sync-alt mr-1"></i> Regenerate
      </button>
    `;
            }
            const safeId = id ?? '';
            buttons += `
            <button class="bm-gear-btn" title="Pengaturan" onclick="toggleTextSettings(event,'${type}','${safeId}')">
    <i class="fas fa-gear"></i>
  </button>
                <button onclick="copySection('${type}', '${id}')"
                        class="px-3 py-1 bg-green-500 text-white rounded text-sm hover:bg-green-600 transition-colors duration-200">
                    <i class="far fa-copy mr-1"></i> Copy
                </button>



                <button onclick="deleteSection('${type}', '${id}')"
                        class="px-3 py-1 bg-red-500 text-white rounded text-sm hover:bg-red-600 transition-colors duration-200">
                    <i class="fas fa-trash-alt mr-1"></i> Hapus
                </button>
            `;

            return `
            <div class="action-buttons flex gap-2 mb-3 justify-end flex-wrap">
                ${buttons}
            </div>
            `;
        }

        function getChapterById(chapterId) {
            return ebookState.chapters.find(c => c.id === chapterId);
        }

        function extractSubBabsFromChapterHtml(chapterHtml) {
            const temp = document.createElement('div');
            temp.innerHTML = chapterHtml || '';
            const list = [];
            temp.querySelectorAll('h3').forEach(h3 => {
                const t = (h3.textContent || '').trim();
                const m = t.match(/^(\d+\.\d+)\s+(.+)$/);
                if (m) list.push({
                    number: m[1],
                    title: m[2].trim()
                });
            });
            return list;
        }

        function getSubBabSegmentHtml(chapterHtml, subBabNumber) {
            const temp = document.createElement('div');
            temp.innerHTML = chapterHtml || '';

            const h3s = Array.from(temp.querySelectorAll('h3'));
            const idx = h3s.findIndex(h => (h.textContent || '').trim().startsWith(subBabNumber + ' '));

            if (idx === -1) return {
                found: false,
                segmentHtml: '',
                segmentText: ''
            };

            const startH3 = h3s[idx];
            const endH3 = h3s[idx + 1] || null;

            // Ambil semua node setelah startH3 sampai sebelum endH3
            const nodes = [];
            let cur = startH3.nextSibling;
            while (cur && cur !== endH3) {
                nodes.push(cur);
                cur = cur.nextSibling;
            }

            const wrapper = document.createElement('div');
            wrapper.appendChild(startH3.cloneNode(true));
            nodes.forEach(n => wrapper.appendChild(n.cloneNode(true)));

            const segmentHtml = wrapper.innerHTML;

            // text (untuk prompt) - dibatasi biar tidak kebanyakan
            const segmentText = (wrapper.textContent || '').replace(/\s+/g, ' ').trim().slice(0, 2500);

            return {
                found: true,
                segmentHtml,
                segmentText
            };
        }

        function insertSnippetAfterSubBab(chapterHtml, subBabNumber, snippetHtml) {
            const temp = document.createElement('div');
            temp.innerHTML = chapterHtml || '';

            const h3s = Array.from(temp.querySelectorAll('h3'));
            const idx = h3s.findIndex(h => (h.textContent || '').trim().startsWith(subBabNumber + ' '));
            if (idx === -1) return chapterHtml; // fallback: tidak berubah

            const startH3 = h3s[idx];
            const endH3 = h3s[idx + 1] || null;

            // cari posisi sisip: sebelum endH3 atau di akhir
            const frag = document.createElement('div');
            frag.innerHTML = snippetHtml || '';

            if (endH3) {
                // sisip sebelum endH3 (paling rapi)
                const parent = endH3.parentNode;
                Array.from(frag.childNodes).forEach(n => parent.insertBefore(n, endH3));
            } else {
                // tidak ada subbab berikutnya -> append di akhir bab
                Array.from(frag.childNodes).forEach(n => temp.appendChild(n));
            }

            return temp.innerHTML;
        }

        async function continueChapter(chapterId) {
            const chapter = getChapterById(chapterId);
            if (!chapter) return showToast("Bab tidak ditemukan", "error");

            const apiKey = document.getElementById("api_key_input").value.trim();
            if (!apiKey) return showToast("API Key belum disimpan.", "error");

            if (isGenerating) return showToast("Sedang membuat konten, mohon tunggu...", "warning");

            const val = getFormValues();

            isGenerating = true;
            showLoadingIndicator("chapter");

            try {
                const response = await fetch("/ebook/generate", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        action: "continue_chapter",
                        masalah: val.masalah,
                        kebutuhan: val.kebutuhan,
                        solusi: val.solusi,
                        pengalaman: val.pengalaman,
                        kompetensi: val.kompetensi,
                        kontrak_kreatif: val.kontrak_kreatif,
                        calon_pembaca: val.calon_pembaca,
                        gaya: val.gaya,
                        tentang_penulis: val.tentang_penulis,
                        pengantar_penulis: val.pengantar_penulis,

                        existing_title: ebookState.title || "",
                        chapter_number: chapter.chapterNumber,
                        chapter_title: chapter.title,
                        chapter_html: chapter.content
                    })
                });

                const result = await response.json();
                if (!result.status) return showToast(result.message || "Gagal melanjutkan bab", "error");

                // ambil referensi dari snippet (kalau ada)
                const extracted = extractReferencesFromChapterHtml(result.html);
                ebookState.references = mergeUniqueRefs(ebookState.references || [], extracted.refs);

                // append snippet ke akhir bab
                chapter.content = insertSnippetBeforeFirstSubBab(
                    chapter.content,
                    chapter.chapterNumber,
                    (extracted.cleanHtml || '').trim()
                );

                saveEbookState();
                renderEbookContent();
                showToast("Bab berhasil dilanjutkan!", "success");
            } catch (e) {
                console.error(e);
                showToast("Error melanjutkan bab: " + e.message, "error");
            } finally {
                isGenerating = false;
                removeLoadingIndicator();
            }
        }

        function stripHtmlToText(html, maxLen = 2500) {
            const temp = document.createElement('div');
            temp.innerHTML = html || '';
            return (temp.textContent || '')
                .replace(/\s+/g, ' ')
                .trim()
                .slice(0, maxLen);
        }

        async function continuePreface() {
            if (!ebookState.preface) return showToast("Kata Pengantar belum dibuat", "warning");

            const apiKey = document.getElementById("api_key_input").value.trim();
            if (!apiKey) return showToast("API Key belum disimpan.", "error");

            if (isGenerating) return showToast("Sedang membuat konten, mohon tunggu...", "warning");

            const val = getFormValues();

            isGenerating = true;
            showLoadingIndicator("preface");

            try {
                const response = await fetch("/ebook/generate", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        action: "continue_preface",

                        masalah: val.masalah,
                        kebutuhan: val.kebutuhan,
                        solusi: val.solusi,
                        pengalaman: val.pengalaman,
                        kompetensi: val.kompetensi,
                        kontrak_kreatif: val.kontrak_kreatif,
                        calon_pembaca: val.calon_pembaca,
                        gaya: val.gaya,
                        existing_title: ebookState.title || "",

                        // konteks kata pengantar saat ini
                        preface_text: stripHtmlToText(ebookState.preface, 2500),
                        preface_html: ebookState.preface
                    })
                });

                const result = await response.json();
                if (!result.status) return showToast(result.message || "Gagal memperpanjang kata pengantar", "error");

                // Append hasil AI ke akhir kata pengantar
                ebookState.preface = (ebookState.preface || '') + "\n" + (result.html || '').trim();

                saveEbookState();
                renderEbookContent();
                showToast("Kata Pengantar berhasil diperpanjang!", "success");
            } catch (e) {
                console.error(e);
                showToast("Error memperpanjang kata pengantar: " + e.message, "error");
            } finally {
                isGenerating = false;
                removeLoadingIndicator();
            }
        }

        async function continueSummary() {
            if (!ebookState.summary) return showToast("Ringkasan belum dibuat", "warning");

            const apiKey = document.getElementById("api_key_input").value.trim();
            if (!apiKey) return showToast("API Key belum disimpan.", "error");

            if (isGenerating) return showToast("Sedang membuat konten, mohon tunggu...", "warning");

            const val = getFormValues();

            isGenerating = true;
            showLoadingIndicator("summary");

            try {
                const response = await fetch("/ebook/generate", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        action: "continue_summary",

                        masalah: val.masalah,
                        kebutuhan: val.kebutuhan,
                        solusi: val.solusi,
                        pengalaman: val.pengalaman,
                        kompetensi: val.kompetensi,
                        kontrak_kreatif: val.kontrak_kreatif,
                        calon_pembaca: val.calon_pembaca,
                        gaya: val.gaya,
                        existing_title: ebookState.title || "",

                        // konteks ringkasan saat ini
                        summary_text: stripHtmlToText(ebookState.summary, 2500),
                        summary_html: ebookState.summary
                    })
                });

                // Aman kalau server balikin HTML error (419/500) biar gak "Unexpected token <"
                const text = await response.text();
                let result;
                try {
                    result = JSON.parse(text);
                } catch (e) {
                    console.error("Server tidak mengembalikan JSON:", text);
                    showToast("Response server bukan JSON (cek error 419/500 di Network).", "error");
                    return;
                }

                if (!result.status) return showToast(result.message || "Gagal memperpanjang ringkasan", "error");

                // Append hasil AI ke akhir ringkasan
                ebookState.summary = (ebookState.summary || '') + "\n" + (result.html || "").trim();

                saveEbookState();
                renderEbookContent();
                showToast("Ringkasan berhasil diperpanjang!", "success");

            } catch (e) {
                console.error(e);
                showToast("Error memperpanjang ringkasan: " + e.message, "error");
            } finally {
                isGenerating = false;
                removeLoadingIndicator();
            }
        }


        async function continueClosing() {
            if (!ebookState.closing) return showToast("Penutup belum dibuat", "warning");

            const apiKey = document.getElementById("api_key_input").value.trim();
            if (!apiKey) return showToast("API Key belum disimpan.", "error");

            if (isGenerating) return showToast("Sedang membuat konten, mohon tunggu...", "warning");

            const val = getFormValues();

            isGenerating = true;
            showLoadingIndicator("closing");

            try {
                const response = await fetch("/ebook/generate", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    body: JSON.stringify({
                        action: "continue_closing",

                        masalah: val.masalah,
                        kebutuhan: val.kebutuhan,
                        solusi: val.solusi,
                        pengalaman: val.pengalaman,
                        kompetensi: val.kompetensi,
                        kontrak_kreatif: val.kontrak_kreatif,
                        calon_pembaca: val.calon_pembaca,
                        gaya: val.gaya,
                        existing_title: ebookState.title || "",

                        // konteks penutup saat ini
                        closing_text: stripHtmlToText(ebookState.closing, 2500),
                        closing_html: ebookState.closing,

                        // pastikan penutup TIDAK menulis tentang penulis
                        dont_write_author_section: true
                    })
                });

                // ✅ Aman kalau server balikin HTML error (419/500/login page)
                const raw = await response.text();
                let result;
                try {
                    result = JSON.parse(raw);
                } catch (e) {
                    console.error("Response bukan JSON:", raw);
                    showToast(
                        "Response server bukan JSON. Cek Network: kemungkinan 419/500 atau route belum handle continue_closing.",
                        "error");
                    return;
                }

                if (!result.status) {
                    showToast(result.message || "Gagal memperpanjang penutup", "error");
                    return;
                }

                // ✅ Append + sanitasi (hapus bagian tentang penulis kalau nyelip)
                const snippet = (result.html || "").trim();
                ebookState.closing = sanitizeClosingHtml(
                    (ebookState.closing || "") + "\n" + snippet
                );

                saveEbookState();
                renderEbookContent();
                showToast("Penutup berhasil diperpanjang!", "success");

            } catch (e) {
                console.error(e);
                showToast("Error memperpanjang penutup: " + e.message, "error");
            } finally {
                isGenerating = false;
                removeLoadingIndicator();
            }
        }



        function openContinueSubBabModal(chapterId) {
            const chapter = getChapterById(chapterId);
            if (!chapter) return showToast("Bab tidak ditemukan", "error");

            const subs = extractSubBabsFromChapterHtml(chapter.content);
            if (!subs.length) return showToast("Sub-bab tidak ditemukan pada bab ini", "warning");

            // modal
            const overlay = document.createElement('div');
            overlay.className = "fixed inset-0 z-50 bg-black/40 flex items-center justify-center p-4";
            overlay.innerHTML = `
      <div class="bg-white w-full max-w-md rounded-xl shadow-lg p-5">
        <div class="flex items-center justify-between mb-3">
          <h3 class="text-lg font-semibold">Lanjutkan Sub-bab</h3>
          <button class="text-gray-500 hover:text-gray-700" id="closeModalBtn">
            <i class="fas fa-times"></i>
          </button>
        </div>

        <label class="text-sm font-medium block mb-2">Pilih sub-bab yang mau dilanjutkan:</label>
        <select id="subbabSelect" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
          ${subs.map(s => `<option value="${s.number}">${s.number} — ${escapeHtml(s.title)}</option>`).join('')}
        </select>

        <div class="mt-4 flex gap-2 justify-end">
          <button id="cancelBtn" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-sm">Batal</button>
          <button id="goBtn" class="px-4 py-2 rounded-lg bg-teal-600 hover:bg-teal-700 text-white text-sm">
            <i class="fas fa-forward mr-1"></i> Lanjutkan
          </button>
        </div>
      </div>
    `;

            document.body.appendChild(overlay);

            const close = () => overlay.remove();
            overlay.querySelector('#closeModalBtn').onclick = close;
            overlay.querySelector('#cancelBtn').onclick = close;

            overlay.querySelector('#goBtn').onclick = async () => {
                const subBabNumber = overlay.querySelector('#subbabSelect').value;
                close();
                await continueSubBab(chapterId, subBabNumber);
            };
        }

        function openContinueIntroModal() {
            if (!ebookState.intro) return showToast("Pendahuluan belum dibuat", "warning");

            const options = [{
                    key: "Pendahuluan",
                    label: "Pendahuluan"
                },
                {
                    key: "Untuk Siapa Buku Ini",
                    label: "Untuk Siapa Buku Ini"
                },
                {
                    key: "Cara Menggunakan Buku Ini",
                    label: "Cara Menggunakan Buku Ini"
                },
            ];

            const overlay = document.createElement('div');
            overlay.className = "fixed inset-0 z-50 bg-black/40 flex items-center justify-center p-4";
            overlay.innerHTML = `
    <div class="bg-white w-full max-w-md rounded-xl shadow-lg p-5">
      <div class="flex items-center justify-between mb-3">
        <h3 class="text-lg font-semibold">Perpanjang Bagian Intro</h3>
        <button class="text-gray-500 hover:text-gray-700" id="closeIntroModalBtn">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <label class="text-sm font-medium block mb-2">Pilih bagian yang mau diperpanjang:</label>
      <select id="introPartSelect" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
        ${options.map(o => `<option value="${escapeHtml(o.key)}">${escapeHtml(o.label)}</option>`).join('')}
      </select>

      <div class="mt-4 flex gap-2 justify-end">
        <button id="cancelIntroBtn" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-sm">Batal</button>
        <button id="goIntroBtn" class="px-4 py-2 rounded-lg bg-teal-600 hover:bg-teal-700 text-white text-sm">
          <i class="fas fa-forward mr-1"></i> Perpanjang
        </button>
      </div>
    </div>
  `;

            document.body.appendChild(overlay);

            const close = () => overlay.remove();
            overlay.querySelector('#closeIntroModalBtn').onclick = close;
            overlay.querySelector('#cancelIntroBtn').onclick = close;

            overlay.querySelector('#goIntroBtn').onclick = async () => {
                const heading = overlay.querySelector('#introPartSelect').value;
                close();
                await continueIntroPart(heading);
            };
        }

        function getH2SegmentHtml(html, headingText) {
            const temp = document.createElement('div');
            temp.innerHTML = html || '';

            const h2s = Array.from(temp.querySelectorAll('h2'));
            const idx = h2s.findIndex(h => (h.textContent || '').trim().toLowerCase() === String(headingText).trim()
                .toLowerCase());

            if (idx === -1) {
                return {
                    found: false,
                    segmentHtml: '',
                    segmentText: ''
                };
            }

            const startH2 = h2s[idx];
            const endH2 = h2s[idx + 1] || null;

            const nodes = [];
            let cur = startH2.nextSibling;
            while (cur && cur !== endH2) {
                nodes.push(cur);
                cur = cur.nextSibling;
            }

            const wrapper = document.createElement('div');
            wrapper.appendChild(startH2.cloneNode(true));
            nodes.forEach(n => wrapper.appendChild(n.cloneNode(true)));

            const segmentHtml = wrapper.innerHTML;
            const segmentText = (wrapper.textContent || '').replace(/\s+/g, ' ').trim().slice(0, 2500);

            return {
                found: true,
                segmentHtml,
                segmentText
            };
        }

        function insertSnippetIntoH2Section(html, headingText, snippetHtml) {
            const temp = document.createElement('div');
            temp.innerHTML = html || '';

            const h2s = Array.from(temp.querySelectorAll('h2'));
            const idx = h2s.findIndex(h => (h.textContent || '').trim().toLowerCase() === String(headingText).trim()
                .toLowerCase());

            if (idx === -1) return html;

            const endH2 = h2s[idx + 1] || null;

            const frag = document.createElement('div');
            frag.innerHTML = snippetHtml || '';

            if (endH2) {
                const parent = endH2.parentNode;
                Array.from(frag.childNodes).forEach(n => parent.insertBefore(n, endH2));
            } else {
                Array.from(frag.childNodes).forEach(n => temp.appendChild(n));
            }

            return temp.innerHTML;
        }

        async function continueIntroPart(headingText) {
            if (!ebookState.intro) return showToast("Pendahuluan belum dibuat", "warning");

            const apiKey = document.getElementById("api_key_input").value.trim();
            if (!apiKey) return showToast("API Key belum disimpan.", "error");

            if (isGenerating) return showToast("Sedang membuat konten, mohon tunggu...", "warning");

            const seg = getH2SegmentHtml(ebookState.intro, headingText);
            if (!seg.found) {
                return showToast(`Bagian "${headingText}" tidak ditemukan di Pendahuluan`, "error");
            }

            const val = getFormValues();

            isGenerating = true;
            showLoadingIndicator("intro");

            try {
                const response = await fetch("/ebook/generate", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        action: "continue_intro_part",
                        masalah: val.masalah,
                        kebutuhan: val.kebutuhan,
                        solusi: val.solusi,
                        pengalaman: val.pengalaman,
                        kompetensi: val.kompetensi,
                        kontrak_kreatif: val.kontrak_kreatif,
                        calon_pembaca: val.calon_pembaca,
                        gaya: val.gaya,
                        existing_title: ebookState.title || "",

                        intro_heading: headingText,
                        intro_text: seg.segmentText,
                        intro_html: ebookState.intro
                    })
                });

                const result = await response.json();
                if (!result.status) return showToast(result.message || "Gagal memperpanjang intro", "error");

                // Sisipkan hasil AI tepat di bagian heading yang dipilih
                ebookState.intro = insertSnippetIntoH2Section(ebookState.intro, headingText, (result.html || '')
                    .trim());

                saveEbookState();
                renderEbookContent();
                showToast(`Bagian "${headingText}" berhasil diperpanjang!`, "success");
            } catch (e) {
                console.error(e);
                showToast("Error memperpanjang intro: " + e.message, "error");
            } finally {
                isGenerating = false;
                removeLoadingIndicator();
            }
        }


        function insertSnippetBeforeFirstSubBab(chapterHtml, chapterNumber, snippetHtml) {
            const temp = document.createElement('div');
            temp.innerHTML = chapterHtml || '';

            const frag = document.createElement('div');
            frag.innerHTML = snippetHtml || '';

            // cari sub-bab pertama: h3 yang diawali "X.Y" sesuai nomor bab
            const re = new RegExp('^\\s*' + chapterNumber + '\\.\\d+\\b');
            const firstSubBab = Array.from(temp.querySelectorAll('h3'))
                .find(h => re.test((h.textContent || '').trim()));

            if (firstSubBab) {
                const parent = firstSubBab.parentNode;
                Array.from(frag.childNodes).forEach(n => parent.insertBefore(n, firstSubBab));
                return temp.innerHTML;
            }

            // fallback: kalau tidak ketemu sub-bab, sisipkan setelah <h2> (judul bab)
            const h2 = temp.querySelector('h2');
            if (h2 && h2.parentNode) {
                const parent = h2.parentNode;
                const refNode = h2.nextSibling; // bisa null (berarti append)
                Array.from(frag.childNodes).forEach(n => parent.insertBefore(n, refNode));
                return temp.innerHTML;
            }

            // fallback terakhir: append
            Array.from(frag.childNodes).forEach(n => temp.appendChild(n));
            return temp.innerHTML;
        }


        function escapeHtml(str) {
            return String(str || '')
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');
        }

        function sanitizeClosingHtml(html) {
            const temp = document.createElement('div');
            temp.innerHTML = html || '';

            // 1) Hapus section yang jelas-jelas tentang penulis
            const badHeadingRe =
                /(tentang\s+penulis|profil\s+penulis|bio\s+penulis|sekilas\s+tentang\s+penulis|penulis\s*\(opsional\))/i;

            const headings = Array.from(temp.querySelectorAll('h1,h2,h3,h4,h5,h6'));
            headings.forEach(h => {
                const t = (h.textContent || '').trim();
                if (!badHeadingRe.test(t)) return;

                // hapus heading + semua node setelahnya sampai heading berikutnya
                const toRemove = [h];
                let cur = h.nextSibling;
                while (cur && !(cur.nodeType === 1 && /^H[1-6]$/.test(cur.tagName))) {
                    toRemove.push(cur);
                    cur = cur.nextSibling;
                }
                toRemove.forEach(n => n?.remove?.());
            });

            // 2) Hapus “signature” pendek yang sering muncul (mis. "Penulis", "— Penulis")
            Array.from(temp.querySelectorAll('p,div')).forEach(el => {
                const txt = (el.textContent || '').replace(/\s+/g, ' ').trim().toLowerCase();
                if (txt === 'penulis' || txt === '- penulis' || txt === '— penulis' || txt === '(penulis)') {
                    el.remove();
                }
            });

            return temp.innerHTML.trim();
        }

        async function continueSubBab(chapterId, subBabNumber) {
            const chapter = getChapterById(chapterId);
            if (!chapter) return showToast("Bab tidak ditemukan", "error");

            const apiKey = document.getElementById("api_key_input").value.trim();
            if (!apiKey) return showToast("API Key belum disimpan.", "error");

            const subInfo = extractSubBabsFromChapterHtml(chapter.content).find(s => s.number === subBabNumber);
            if (!subInfo) return showToast("Sub-bab tidak ditemukan", "error");

            const seg = getSubBabSegmentHtml(chapter.content, subBabNumber);
            if (!seg.found) return showToast("Gagal membaca segmen sub-bab", "error");

            if (isGenerating) return showToast("Sedang membuat konten, mohon tunggu...", "warning");

            const val = getFormValues();

            isGenerating = true;
            showLoadingIndicator("chapter");

            try {
                const response = await fetch("/ebook/generate", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        action: "continue_subbab",
                        masalah: val.masalah,
                        kebutuhan: val.kebutuhan,
                        solusi: val.solusi,
                        pengalaman: val.pengalaman,
                        kompetensi: val.kompetensi,
                        kontrak_kreatif: val.kontrak_kreatif,
                        calon_pembaca: val.calon_pembaca,
                        gaya: val.gaya,

                        existing_title: ebookState.title || "",
                        chapter_number: chapter.chapterNumber,
                        chapter_title: chapter.title,

                        subbab_number: subBabNumber,
                        subbab_title: subInfo.title,
                        subbab_text: seg.segmentText,
                        chapter_html: chapter.content
                    })
                });

                const result = await response.json();
                if (!result.status) return showToast(result.message || "Gagal melanjutkan sub-bab", "error");

                // extract referensi dari snippet
                const extracted = extractReferencesFromChapterHtml(result.html);
                ebookState.references = mergeUniqueRefs(ebookState.references || [], extracted.refs);

                // sisipkan snippet tepat setelah sub-bab tsb
                chapter.content = insertSnippetAfterSubBab(chapter.content, subBabNumber, extracted.cleanHtml);

                saveEbookState();
                renderEbookContent();
                showToast(`Sub-bab ${subBabNumber} berhasil dilanjutkan!`, "success");
            } catch (e) {
                console.error(e);
                showToast("Error melanjutkan sub-bab: " + e.message, "error");
            } finally {
                isGenerating = false;
                removeLoadingIndicator();
            }
        }

        // ====== EXTEND OUTLINE (Tambah Bab / Tambah Sub-bab) ======
        function outlineGetMainOl(outlineHtml) {
            const temp = document.createElement('div');
            temp.innerHTML = outlineHtml || '';
            const ol = temp.querySelector('ol');
            return {
                temp,
                ol
            };
        }

        function outlineGetSubBabCount(outlineHtml, chapterNumber) {
            const data = extractChapterTitlesFromOutline(); // sudah ada di kode kamu
            const ch = data.find(x => x.number === chapterNumber);
            return ch ? (ch.subBabs?.length || 0) : 0;
        }

        function openExtendOutlineModal() {
            if (!ebookState.outline) return showToast("Daftar isi belum dibuat.", "warning");

            const chapters = extractChapterTitlesFromOutline();
            if (!chapters.length) return showToast("Tidak menemukan struktur bab dari daftar isi.", "warning");

            const overlay = document.createElement('div');
            overlay.className = "fixed inset-0 z-50 bg-black/40 flex items-center justify-center p-4";
            overlay.innerHTML = `
    <div class="bg-white w-full max-w-lg rounded-xl shadow-lg p-5">
      <div class="flex items-center justify-between mb-3">
        <h3 class="text-lg font-semibold">Perpanjang Daftar Isi</h3>
        <button class="text-gray-500 hover:text-gray-700" id="closeModalBtn">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <div class="space-y-3">
        <label class="flex items-center gap-2 text-sm">
          <input type="radio" name="extMode" value="add_chapter" checked />
          <span><b>Tambah Bab Baru</b> (otomatis + sub-bab)</span>
        </label>

        <label class="flex items-center gap-2 text-sm">
          <input type="radio" name="extMode" value="add_subbab" />
          <span><b>Tambah Sub-bab</b> ke Bab tertentu</span>
        </label>

        <div id="pickBabWrap" class="mt-2 hidden">
          <label class="text-sm font-medium block mb-2">Pilih bab:</label>
          <select id="pickBabSelect" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            ${chapters.map(ch => `<option value="${ch.number}">Bab ${ch.number}: ${escapeHtml(ch.title)}</option>`).join('')}
          </select>

          <label class="text-sm font-medium block mt-3 mb-2">Tambah berapa sub-bab?</label>
          <select id="addCountSelect" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            <option value="1">+1 sub-bab</option>
            <option value="2" selected>+2 sub-bab</option>
            <option value="3">+3 sub-bab</option>
          </select>
        </div>
      </div>

      <div class="mt-5 flex gap-2 justify-end">
        <button id="cancelBtn" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-sm">Batal</button>
        <button id="goBtn" class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-sm">
          <i class="fas fa-plus mr-1"></i> Terapkan
        </button>
      </div>
    </div>
  `;

            document.body.appendChild(overlay);

            const close = () => overlay.remove();
            overlay.querySelector('#closeModalBtn').onclick = close;
            overlay.querySelector('#cancelBtn').onclick = close;

            const radios = overlay.querySelectorAll('input[name="extMode"]');
            const pickWrap = overlay.querySelector('#pickBabWrap');

            const refreshUI = () => {
                const mode = overlay.querySelector('input[name="extMode"]:checked')?.value;
                pickWrap.classList.toggle('hidden', mode !== 'add_subbab');
            };
            radios.forEach(r => r.onchange = refreshUI);
            refreshUI();

            overlay.querySelector('#goBtn').onclick = async () => {
                const mode = overlay.querySelector('input[name="extMode"]:checked')?.value;

                if (mode === 'add_chapter') {
                    close();
                    await extendOutlineAddChapter();
                    return;
                }

                const chapterNum = parseInt(overlay.querySelector('#pickBabSelect').value, 10);
                const addCount = parseInt(overlay.querySelector('#addCountSelect').value, 10);
                close();
                await extendOutlineAddSubBab(chapterNum, addCount);
            };
        }

        async function extendOutlineAddChapter() {
            const apiKey = document.getElementById("api_key_input").value.trim();
            if (!apiKey) return showToast("API Key belum disimpan.", "error");
            if (!ebookState.outline) return showToast("Daftar isi belum ada.", "error");
            if (isGenerating) return showToast("Sedang membuat konten, mohon tunggu...", "warning");

            const val = getFormValues();
            const chapters = extractChapterTitlesFromOutline();
            const nextChapterNumber = (chapters.length || 0) + 1;

            isGenerating = true;
            showLoadingIndicator("outline");

            try {
                const response = await fetch("/ebook/generate", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        action: "extend_outline",
                        extend_mode: "add_chapter",
                        next_chapter_number: nextChapterNumber,
                        outline_html: ebookState.outline,

                        // konteks buku
                        masalah: val.masalah,
                        kebutuhan: val.kebutuhan,
                        solusi: val.solusi,
                        pengalaman: val.pengalaman,
                        kompetensi: val.kompetensi,
                        kontrak_kreatif: val.kontrak_kreatif,
                        calon_pembaca: val.calon_pembaca,
                        gaya: val.gaya,
                        jumlah_outline: val.jumlah_outline,
                        existing_title: ebookState.title || ""
                    })
                });

                const result = await response.json();
                if (!result.status) return showToast(result.message || "Gagal menambah bab di daftar isi", "error");

                // result.html = <li>Bab N: ...<ul>...</ul></li>
                const {
                    temp,
                    ol
                } = outlineGetMainOl(ebookState.outline);
                if (!ol) return showToast("Struktur <ol> daftar isi tidak ditemukan.", "error");

                const wrap = document.createElement('div');
                wrap.innerHTML = result.html || '';
                const li = wrap.querySelector('li');
                if (!li) return showToast("Format hasil AI tidak valid (li tidak ditemukan).", "error");

                ol.appendChild(li);
                ebookState.outline = temp.innerHTML;

                saveEbookState();
                renderEbookContent();
                showToast(`Bab ${nextChapterNumber} berhasil ditambahkan ke daftar isi!`, "success");
            } catch (e) {
                console.error(e);
                showToast("Error perpanjang daftar isi: " + e.message, "error");
            } finally {
                isGenerating = false;
                removeLoadingIndicator();
            }
        }

        async function extendOutlineAddSubBab(chapterNumber, addCount = 2) {
            const apiKey = document.getElementById("api_key_input").value.trim();
            if (!apiKey) return showToast("API Key belum disimpan.", "error");
            if (!ebookState.outline) return showToast("Daftar isi belum ada.", "error");
            if (isGenerating) return showToast("Sedang membuat konten, mohon tunggu...", "warning");

            const val = getFormValues();
            const lastCount = outlineGetSubBabCount(ebookState.outline,
                chapterNumber); // misal sudah 5, maka next mulai 6

            isGenerating = true;
            showLoadingIndicator("outline");

            try {
                const response = await fetch("/ebook/generate", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        action: "extend_outline",
                        extend_mode: "add_subbab",
                        outline_html: ebookState.outline,

                        chapter_number: chapterNumber,
                        last_subbab_index: lastCount,
                        add_count: addCount,

                        // konteks buku
                        masalah: val.masalah,
                        kebutuhan: val.kebutuhan,
                        solusi: val.solusi,
                        pengalaman: val.pengalaman,
                        kompetensi: val.kompetensi,
                        kontrak_kreatif: val.kontrak_kreatif,
                        calon_pembaca: val.calon_pembaca,
                        gaya: val.gaya,
                        jumlah_outline: val.jumlah_outline,
                        existing_title: ebookState.title || ""
                    })
                });

                const result = await response.json();
                if (!result.status) return showToast(result.message || "Gagal menambah sub-bab", "error");

                // result.html = beberapa <li>X.Y ...</li> (tanpa ul)
                const {
                    temp,
                    ol
                } = outlineGetMainOl(ebookState.outline);
                if (!ol) return showToast("Struktur <ol> daftar isi tidak ditemukan.", "error");

                // cari LI bab yang sesuai, lalu UL-nya
                const babLi = Array.from(ol.children).find(li => {
                    const txt = (li.firstChild?.textContent || li.textContent || '').trim();
                    return new RegExp(`^\\s*Bab\\s+${chapterNumber}\\s*:\\s*`, 'i').test(txt);
                });

                if (!babLi) return showToast(`Bab ${chapterNumber} tidak ditemukan di daftar isi.`, "error");

                let ul = babLi.querySelector('ul');
                if (!ul) {
                    ul = document.createElement('ul');
                    babLi.appendChild(ul);
                }

                const wrap = document.createElement('div');
                wrap.innerHTML = `<ul>${result.html || ''}</ul>`;
                const newLis = wrap.querySelectorAll('li');
                if (!newLis.length) return showToast("Format hasil AI tidak valid (li sub-bab tidak ditemukan).",
                    "error");

                newLis.forEach(li => ul.appendChild(li));
                ebookState.outline = temp.innerHTML;

                saveEbookState();
                renderEbookContent();
                showToast(`Sub-bab untuk Bab ${chapterNumber} berhasil ditambahkan!`, "success");
            } catch (e) {
                console.error(e);
                showToast("Error perpanjang sub-bab di daftar isi: " + e.message, "error");
            } finally {
                isGenerating = false;
                removeLoadingIndicator();
            }
        }


        function moveSectionUp(type, id) {
            if (type === 'chapter') {
                const index = ebookState.chapters.findIndex(c => c.id === id);
                if (index > 0) {
                    const temp = ebookState.chapters[index];
                    ebookState.chapters[index] = ebookState.chapters[index - 1];
                    ebookState.chapters[index - 1] = temp;

                    // Update chapter numbers
                    ebookState.chapters.forEach((chapter, i) => {
                        chapter.chapterNumber = i + 1;
                    });

                    saveEbookState();
                    renderEbookContent();
                    showToast("Bab berhasil dipindahkan ke atas", "success");
                }
            }
        }

        function moveSectionDown(type, id) {
            if (type === 'chapter') {
                const index = ebookState.chapters.findIndex(c => c.id === id);
                if (index < ebookState.chapters.length - 1) {
                    const temp = ebookState.chapters[index];
                    ebookState.chapters[index] = ebookState.chapters[index + 1];
                    ebookState.chapters[index + 1] = temp;

                    // Update chapter numbers
                    ebookState.chapters.forEach((chapter, i) => {
                        chapter.chapterNumber = i + 1;
                    });

                    saveEbookState();
                    renderEbookContent();
                    showToast("Bab berhasil dipindahkan ke bawah", "success");
                }
            }
        }

        async function insertChapterAfter(afterId) {
            const val = getFormValues();
            const apiKey = document.getElementById("api_key_input").value.trim();

            if (!apiKey) {
                showToast("API Key belum disimpan.", "error");
                return;
            }

            // Validasi apakah ada bab dengan ID tersebut
            const afterIndex = ebookState.chapters.findIndex(c => c.id === afterId);
            if (afterIndex === -1) {
                showToast("Bab tidak ditemukan", "error");
                return;
            }

            // Tentukan posisi sisip (setelah bab dengan ID afterId)
            const insertIndex = afterIndex + 1;

            // Tentukan nomor bab untuk bab baru
            const targetChapter = ebookState.chapters[afterIndex].chapterNumber + 1;

            // Update nomor bab untuk bab-bab setelah posisi sisip
            for (let i = insertIndex; i < ebookState.chapters.length; i++) {
                ebookState.chapters[i].chapterNumber += 1;
            }

            isGenerating = true;
            showLoadingIndicator("chapter");

            try {
                // Ambil judul bab dari daftar isi jika ada
                const chapterTitles = extractChapterTitles();
                const existingChaptersCount = ebookState.chapters.length;

                const response = await fetch("/ebook/generate", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        action: "chapter",
                        masalah: val.masalah,
                        kebutuhan: val.kebutuhan,
                        solusi: val.solusi,
                        pengalaman: val.pengalaman,
                        kompetensi: val.kompetensi,
                        kontrak_kreatif: val.kontrak_kreatif,
                        calon_pembaca: val.calon_pembaca,
                        gaya: val.gaya,
                        jumlah_outline: val.jumlah_outline,
                        tentang_penulis: val.tentang_penulis,
                        pengantar_penulis: val.pengantar_penulis,

                        existing_title: ebookState.title || "",
                        current_chapter_count: existingChaptersCount,
                        chapter_titles: chapterTitles,
                        target_chapter: targetChapter,
                        insert_mode: true,
                        previous_chapter_title: ebookState.chapters[afterIndex].title ||
                            `Bab ${ebookState.chapters[afterIndex].chapterNumber - 1}`
                    })
                });

                const result = await response.json();

                if (!result.status) {
                    // Rollback perubahan nomor bab jika gagal
                    for (let i = insertIndex; i < ebookState.chapters.length; i++) {
                        ebookState.chapters[i].chapterNumber -= 1;
                    }
                    showToast(result.message, "error");
                    return;
                }

                // Ekstrak judul bab dari konten yang dihasilkan AI
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = result.html;

                const h2 = tempDiv.querySelector('h2');
                let newChapterTitle = `Bab ${targetChapter}`;

                if (h2) {
                    const text = h2.textContent.trim();
                    const match = text.match(/Bab\s+\d+:\s*(.+)/i);
                    if (match && match[1]) {
                        newChapterTitle = match[1].trim();
                    } else if (text.startsWith(`Bab ${targetChapter}:`)) {
                        newChapterTitle = text.replace(`Bab ${targetChapter}:`, '').trim();
                    } else if (text.startsWith(`BAB ${targetChapter}`)) {
                        newChapterTitle = text.replace(`BAB ${targetChapter}`, '').replace(/^[:\s]+/, '').trim();
                    }
                }

                // Buat objek bab baru
                const newChapter = {
                    id: "chapter_" + Date.now(),
                    content: result.html,
                    type: "chapter",
                    chapterNumber: targetChapter,
                    title: newChapterTitle
                };

                // Sisipkan bab baru pada posisi yang ditentukan
                ebookState.chapters.splice(insertIndex, 0, newChapter);

                // Normalisasi nomor bab untuk memastikan urutan benar
                ebookState.chapters.forEach((chapter, index) => {
                    chapter.chapterNumber = index + 1;
                });

                // LANGSUNG UPDATE DAFTAR ISI TANPA TIMEOUT
                updateOutlineAfterChapterChange();

                // Simpan state dan render
                saveEbookState();
                renderEbookContent();

                showToast(`Bab ${targetChapter}: "${newChapterTitle}" berhasil disisipkan`, "success");

            } catch (err) {
                console.error("Error inserting chapter:", err);

                // Rollback perubahan nomor bab jika error
                for (let i = insertIndex; i < ebookState.chapters.length; i++) {
                    ebookState.chapters[i].chapterNumber -= 1;
                }

                showToast("Gagal menyisipkan bab: " + err.message, "error");
            } finally {
                isGenerating = false;
                removeLoadingIndicator();
            }
        }

        function regenerateSection(type, id) {
            if (confirm(`Anda yakin ingin membuat ulang ${type} ini? Konten lama akan diganti.`)) {
                generateEbook(type);
            }
        }

        function copySection(type, id) {
            // Cari container tempat tombol ini diklik
            const btn = event.target.closest("button");
            const container = btn.closest(".section-container");

            if (!container) {
                showToast("Tidak menemukan konten untuk disalin", "error");
                return;
            }

            const el = container.querySelector("div[contenteditable='true']");

            if (!el) {
                showToast("Tidak menemukan konten untuk disalin", "error");
                return;
            }

            const htmlContent = el.innerText.trim();

            if (!htmlContent) {
                showToast("Konten kosong, tidak bisa menyalin", "error");
                return;
            }

            // Buat textarea untuk copy
            const temp = document.createElement("textarea");
            temp.style.position = "fixed";
            temp.style.opacity = "0";
            temp.value = htmlContent;

            document.body.appendChild(temp);
            temp.select();
            document.execCommand("copy");
            temp.remove();

            showToast("Konten berhasil disalin!", "success");
        }




        function deleteSection(type, id) {
            if (!confirm("Anda yakin ingin menghapus bagian ini?")) return;

            if (type === 'bibliography') {
                ebookState.bibliography = null;
                saveEbookState();
                renderEbookContent();
                showToast("Daftar pustaka dihapus", "success");
                return;
            }
            if (type === 'preface') ebookState.preface = null;
            if (type === 'profilpenulis') ebookState.authorProfile = null;
            if (type === 'chapter') {
                const index = ebookState.chapters.findIndex(c => c.id === id);
                if (index !== -1) {
                    ebookState.chapters.splice(index, 1);

                    // Perbaiki nomor bab setelah dihapus
                    ebookState.chapters.forEach((chapter, i) => {
                        chapter.chapterNumber = i + 1;
                    });

                    saveEbookState();
                    renderEbookContent();
                    showToast("Bab berhasil dihapus", "success");
                }
                return;
            }

            if (type === 'manual') {
                ebookState.manualSections = ebookState.manualSections.filter(s => s.id !== id);
                saveEbookState();
                renderEbookContent();
                showToast("Bagian manual berhasil dihapus", "success");
                return;
            }

            // Untuk title, intro, outline, summary, closing
            if (type === 'title') ebookState.title = null;
            if (type === 'intro') ebookState.intro = null;
            if (type === 'outline') ebookState.outline = null;
            if (type === 'summary') ebookState.summary = null;
            if (type === 'closing') ebookState.closing = null;

            saveEbookState();
            renderEbookContent();
            showToast("Bagian berhasil dihapus", "success");
        }

        function normalizeRefText(t) {
            return (t || '')
                .replace(/\s+/g, ' ')
                .replace(/^\[\s*C\d+\s*\]\s*/i, '') // hapus prefix [C1]
                .trim();
        }

        function mergeUniqueRefs(existing, incoming) {
            const map = new Map();
            (existing || []).forEach(r => {
                const key = normalizeRefText(r).toLowerCase();
                if (key) map.set(key, normalizeRefText(r));
            });
            (incoming || []).forEach(r => {
                const key = normalizeRefText(r).toLowerCase();
                if (key && !map.has(key)) map.set(key, normalizeRefText(r));
            });
            return Array.from(map.values());
        }

        // Ambil referensi dari HTML bab dan hapus blok "Referensi Bab (auto)" dari konten bab
        function extractReferencesFromChapterHtml(chapterHtml) {
            const temp = document.createElement('div');
            temp.innerHTML = chapterHtml || '';

            let foundRefs = [];

            // cari heading referensi
            const headings = temp.querySelectorAll('h2,h3');
            headings.forEach(h => {
                const title = (h.textContent || '').trim().toLowerCase();
                if (title.includes('referensi bab') && title.includes('auto')) {
                    const next = h.nextElementSibling;
                    if (next && (next.tagName === 'UL' || next.tagName === 'OL')) {
                        next.querySelectorAll('li').forEach(li => {
                            const t = normalizeRefText(li.textContent);
                            if (t) foundRefs.push(t);
                        });

                        // hapus heading + list
                        next.remove();
                        h.remove();
                    }
                }
            });

            return {
                cleanHtml: temp.innerHTML,
                refs: foundRefs
            };
        }

        // (Opsional) saat load, rapikan semua bab lama yang masih menyimpan blok referensi
        function rebuildReferencesFromAllChapters() {
            let all = ebookState.references || [];

            ebookState.chapters = (ebookState.chapters || []).map(ch => {
                const {
                    cleanHtml,
                    refs
                } = extractReferencesFromChapterHtml(ch.content);
                if (refs.length) all = mergeUniqueRefs(all, refs);
                return {
                    ...ch,
                    content: cleanHtml
                };
            });

            ebookState.references = all;
        }


        async function generateDaftarPustaka() {
            // pastikan kumpulan referensi up to date (kalau ada bab lama)
            rebuildReferencesFromAllChapters();

            const refs = (ebookState.references || []).map(r => normalizeRefText(r)).filter(Boolean);

            if (refs.length === 0) {
                showToast("Belum ada referensi. Buat Bab (AI) dulu agar kutipan & referensi terkumpul.", "warning");
                return;
            }

            // kirim ke backend untuk diformat rapi jadi HTML
            try {
                isGenerating = true;
                showLoadingIndicator("daftarpustaka");

                const response = await fetch("/ebook/generate", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        action: "daftarpustaka",
                        references: refs
                    })
                });

                const result = await response.json();
                if (!result.status) {
                    showToast(result.message || "Gagal membuat daftar pustaka", "error");
                    return;
                }

                ebookState.bibliography = result.html;
                saveEbookState();
                renderEbookContent();
                showToast("Daftar pustaka berhasil dibuat otomatis!", "success");
            } catch (e) {
                console.error(e);
                showToast("Error membuat daftar pustaka: " + e.message, "error");
            } finally {
                isGenerating = false;
                removeLoadingIndicator();
            }
        }


        function saveManualSection(id, content) {
            const section = ebookState.manualSections.find(s => s.id === id);
            if (section) {
                section.content = content;
                saveEbookState();
                showToast("Perubahan disimpan", "success");
            }
        }

        function saveEditedSection(type, content, id = null) {
            if (type === 'profilpenulis') ebookState.authorProfile = content;
            if (type === 'preface') ebookState.preface = content;
            if (type === 'bibliography') ebookState.bibliography = content;
            if (type === 'title') ebookState.title = content;
            if (type === 'intro') ebookState.intro = content;
            if (type === 'outline') ebookState.outline = content;
            if (type === 'summary') ebookState.summary = content;
            if (type === 'closing') ebookState.closing = content;

            if (type === 'chapter' && id) {
                const chapter = ebookState.chapters.find(c => c.id === id);
                if (chapter) {
                    chapter.content = content;

                    // Update chapter title jika ada perubahan
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = content;
                    const h2 = tempDiv.querySelector('h2');
                    if (h2) {
                        const text = h2.textContent || h2.innerText;
                        const match = text.match(/Bab\s+\d+:\s*(.+)/i);
                        if (match && match[1]) {
                            chapter.title = match[1].trim();
                        }
                    }
                }
            }

            saveEbookState();
            showToast("Perubahan disimpan", "success");
        }

        function resetEbook() {
            if (confirm("Anda yakin ingin menghapus semua konten ebook? Tindakan ini tidak dapat dibatalkan.")) {
                ebookState = {
                    title: null,
                    preface: null,
                    intro: null,
                    outline: null,
                    chapters: [],
                    summary: null,
                    closing: null,
                    manualSections: [],
                    references: [], // ✅ kumpulan referensi unik
                    bibliography: null,
                    authorProfile: null,
                    sectionFormats: {}
                };

                saveEbookState();
                renderEbookContent();
                showToast("Semua konten berhasil direset", "success");
            }
        }

        function downloadEbook() {
            const html = document.getElementById("ebook_content").innerHTML;

            fetch("/ebook/download", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        html: html
                    })
                })
                .then(resp => resp.blob())
                .then(blob => {
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement("a");
                    a.href = url;
                    a.download = "ebook.pdf";
                    a.click();
                });
        }




        function printEbook() {
            const printWindow = window.open('', '_blank');
            const content = document.getElementById('ebook_content').innerHTML;

            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Book - Print</title>
                    <style>
                        body { font-family: 'Times New Roman', serif; font-size: 12pt; line-height: 1.6; }
                        h1 { font-size: 24pt; text-align: center; margin-top: 2in; }
                        h2 { font-size: 18pt; margin-top: 0.5in; }
                        .section-container { page-break-inside: avoid; margin-bottom: 20pt; }
                        @media print {
                            body { margin: 0.5in; }
                        }
                    </style>
                </head>
                <body>
                    ${content}
                </body>
                </html>
            `);

            printWindow.document.close();
            setTimeout(() => {
                printWindow.print();
                printWindow.close();
            }, 500);
        }

        function toggleEbookView() {
            const contentEl = document.getElementById('ebook_content');
            const toggleBtn = document.getElementById('toggleViewBtn');

            isEbookView = !isEbookView;

            if (isEbookView) {
                contentEl.classList.remove('bg-white');
                contentEl.classList.add('ebook-content');
                toggleBtn.innerHTML = '<i class="fas fa-edit mr-1"></i>Edit View';
            } else {
                contentEl.classList.remove('ebook-content');
                contentEl.classList.add('bg-white');
                toggleBtn.innerHTML = '<i class="fas fa-eye mr-1"></i>Book View';
            }
        }

        function showLoadingIndicator(action) {
            const actionText = {
                'title': 'Judul',
                'preface': 'Kata Pengantar',
                'intro': 'Pendahuluan',
                'outline': 'Daftar Isi',
                'chapter': 'Bab Baru',
                'summary': 'Ringkasan',
                'closing': 'Penutup',
                'daftarpustaka': 'Daftar Pustaka',
                'profilpenulis': 'Profil Penulis'
            };

            const loader = document.createElement("div");
            loader.id = "ebook-loader";
            loader.className = "fixed top-4 right-4 z-50 bg-white shadow-lg rounded-lg p-4 border-2 border-blue-500";
            loader.innerHTML = `
                <div class="flex items-center gap-3">
                    <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
                    <div>
                        <p class="text-sm font-medium">Membuat ${actionText[action]}...</p>
                        <p class="text-xs text-gray-500">Harap tunggu sebentar</p>
                    </div>
                </div>
            `;
            document.body.appendChild(loader);
        }

        function removeLoadingIndicator() {
            const loader = document.getElementById("ebook-loader");
            if (loader) loader.remove();
        }

        function showToast(msg, type = "success") {
            const toast = document.createElement("div");
            const icons = {
                "success": "fas fa-check-circle",
                "error": "fas fa-exclamation-circle",
                "warning": "fas fa-exclamation-triangle",
                "info": "fas fa-info-circle"
            };

            toast.className = `fixed top-5 right-5 z-50 px-4 py-3 rounded-lg shadow-lg text-white text-sm transition-all duration-300 transform translate-x-0 flex items-center gap-2 ${
                type === "success" ? "bg-green-600" :
                type === "error" ? "bg-red-600" :
                type === "warning" ? "bg-yellow-600" :
                "bg-blue-600"
            }`;

            toast.innerHTML = `
                <i class="${icons[type] || 'fas fa-info-circle'}"></i>
                <span>${msg}</span>
            `;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.style.opacity = "0";
                toast.style.transform = "translateX(20px)";
            }, 2000);

            setTimeout(() => toast.remove(), 2600);
        }

        document.addEventListener("paste", function(e) {
            const activeElement = document.activeElement;

            // Hanya bekerja untuk contenteditable
            if (activeElement && activeElement.getAttribute("contenteditable") === "true") {
                e.preventDefault();

                let clipboardData = (e.clipboardData || window.clipboardData);

                let htmlData = clipboardData.getData("text/html");
                let textData = clipboardData.getData("text/plain");

                // Jika HTML ada → paste HTML
                if (htmlData) {
                    document.execCommand("insertHTML", false, htmlData);
                } else {
                    // fallback paste text biasa
                    document.execCommand("insertText", false, textData);
                }
            }
        });

        // ====== Image Insert & Toolbar ======
        let __activeEditor = null; // contenteditable terakhir yang fokus
        let __selectedImg = null; // img yang sedang dipilih
        let __imageToolsInit = false;

        function initImageToolsOnce() {
            if (__imageToolsInit) return;
            __imageToolsInit = true;

            // Simpan editor aktif saat fokus
            document.addEventListener('focusin', (e) => {
                const ed = e.target?.closest?.('[contenteditable="true"]');
                if (ed) __activeEditor = ed;
            });

            // Hapus gambar
            document.getElementById('imgDelete').addEventListener('click', () => {
                if (!__selectedImg) return;
                deleteSelectedImage();
            });

            // Delegasi klik: kalau klik gambar => tampilkan toolbar
            document.addEventListener('click', (e) => {
                const toolbar = document.getElementById('img-toolbar');
                const img = e.target?.closest?.('img');

                // klik tombol toolbar jangan menutup
                if (toolbar && toolbar.contains(e.target)) return;

                // jika klik gambar di dalam editor
                if (img && img.closest('[contenteditable="true"]')) {
                    __selectedImg = img;
                    // pastikan kelas untuk style
                    if (!__selectedImg.classList.contains('ebook-img')) {
                        __selectedImg.classList.add('ebook-img');
                    }
                    showImageToolbar(__selectedImg);
                    return;
                }

                // klik di luar => tutup toolbar
                hideImageToolbar();
            });

            // ESC untuk tutup toolbar
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') hideImageToolbar();
            });

            // Range slider
            const range = document.getElementById('imgSizeRange');
            range.addEventListener('input', () => {
                if (!__selectedImg) return;
                const val = parseInt(range.value || '50', 10);
                applyImageWidth(__selectedImg, val);
                updateToolbarUI(__selectedImg);
            });

            // Align buttons
            document.getElementById('imgAlignLeft').addEventListener('click', () => {
                if (!__selectedImg) return;
                setImageAlign(__selectedImg, 'left');
                updateToolbarUI(__selectedImg);
            });
            document.getElementById('imgAlignCenter').addEventListener('click', () => {
                if (!__selectedImg) return;
                setImageAlign(__selectedImg, 'center');
                updateToolbarUI(__selectedImg);
            });
            document.getElementById('imgAlignRight').addEventListener('click', () => {
                if (!__selectedImg) return;
                setImageAlign(__selectedImg, 'right');
                updateToolbarUI(__selectedImg);
            });

            // File input change
            const fileInput = document.getElementById('imgInsertInput');
            fileInput.addEventListener('change', async (e) => {
                const file = e.target.files?.[0];
                if (!file) return;

                try {
                    const dataUrl = await readFileAsDataURL(file);
                    insertImageAtCursor(dataUrl);
                } catch (err) {
                    console.error(err);
                    showToast("Gagal menyisipkan gambar", "error");
                } finally {
                    fileInput.value = ""; // reset supaya bisa pilih file yang sama lagi
                }
            });
        }

        // panggil sekali (aman meskipun renderEbookContent dipanggil berkali-kali)
        initImageToolsOnce();

        function insertImageToSection(type, id) {
            initImageToolsOnce();

            // Fokuskan editor section bab yang dimaksud
            let editor = null;

            if (type === 'chapter') {
                const container = document.querySelector(`.section-container[data-id="${id}"][data-type="chapter"]`);
                editor = container?.querySelector('[contenteditable="true"]') || null;
            } else {
                // fallback: editor aktif terakhir
                editor = __activeEditor;
            }

            if (editor) {
                editor.focus();
                __activeEditor = editor;
            } else {
                showToast("Klik area teks bab dulu sebelum sisip gambar", "warning");
                return;
            }

            // buka picker
            document.getElementById('imgInsertInput').click();
        }

        function readFileAsDataURL(file) {
            return new Promise((resolve, reject) => {
                const r = new FileReader();
                r.onload = () => resolve(r.result);
                r.onerror = reject;
                r.readAsDataURL(file);
            });
        }

        function insertImageAtCursor(dataUrl) {
            const editor = __activeEditor;
            if (!editor) {
                showToast("Klik area teks dulu sebelum sisip gambar", "warning");
                return;
            }

            // Buat elemen img
            const img = document.createElement('img');
            img.src = dataUrl;
            img.alt = "Gambar";
            img.className = "ebook-img";

            // default: 50% center
            applyImageWidth(img, 50);
            setImageAlign(img, 'center');

            // sisipkan di caret
            const sel = window.getSelection();
            if (!sel || sel.rangeCount === 0) {
                // fallback append
                editor.appendChild(img);
                editor.appendChild(document.createElement('p')).innerHTML = "<br>";
            } else {
                const range = sel.getRangeAt(0);
                // pastikan range masih di editor
                if (!editor.contains(range.commonAncestorContainer)) {
                    editor.appendChild(img);
                    editor.appendChild(document.createElement('p')).innerHTML = "<br>";
                } else {
                    range.deleteContents();
                    range.insertNode(img);

                    // tambah paragraf kosong setelah gambar agar bisa lanjut ngetik
                    const p = document.createElement('p');
                    p.innerHTML = "<br>";
                    img.parentNode.insertBefore(p, img.nextSibling);

                    // pindahkan caret ke paragraf kosong
                    const newRange = document.createRange();
                    newRange.setStart(p, 0);
                    newRange.collapse(true);
                    sel.removeAllRanges();
                    sel.addRange(newRange);
                }
            }

            // set selected + tampilkan toolbar
            __selectedImg = img;
            showImageToolbar(img);
            showToast("Gambar berhasil disisipkan", "success");
        }

        function applyImageWidth(img, percent) {
            const p = Math.max(10, Math.min(100, parseInt(percent, 10) || 50));
            img.dataset.width = String(p);
            img.style.width = p + "%";
            img.style.height = "auto";
            img.style.maxWidth = "100%";
            img.style.display = "block";
        }

        function setImageAlign(img, align) {
            img.dataset.align = align;

            // pakai margin auto untuk block align
            img.style.display = "block";
            if (align === 'left') {
                img.style.marginLeft = "0";
                img.style.marginRight = "auto";
            } else if (align === 'center') {
                img.style.marginLeft = "auto";
                img.style.marginRight = "auto";
            } else if (align === 'right') {
                img.style.marginLeft = "auto";
                img.style.marginRight = "0";
            }
        }

        function showImageToolbar(img) {
            const toolbar = document.getElementById('img-toolbar');
            if (!toolbar) return;

            toolbar.style.display = "flex";

            // posisikan toolbar di atas gambar (mirip docs)
            const rect = img.getBoundingClientRect();
            const top = Math.max(10, rect.top - 60);
            let left = rect.left;

            // jangan keluar layar kanan
            const tbW = 360;
            const maxLeft = window.innerWidth - tbW - 10;
            left = Math.max(10, Math.min(left, maxLeft));

            toolbar.style.top = `${top}px`;
            toolbar.style.left = `${left}px`;

            updateToolbarUI(img);
        }

        function hideImageToolbar() {
            const toolbar = document.getElementById('img-toolbar');
            if (toolbar) toolbar.style.display = "none";
            __selectedImg = null;
        }

        function updateToolbarUI(img) {
            const range = document.getElementById('imgSizeRange');
            const label = document.getElementById('imgSizeLabel');

            // width
            let w = parseInt(img.dataset.width || '0', 10);
            if (!w) {
                const styleW = (img.style.width || '').trim();
                if (styleW.endsWith('%')) w = parseInt(styleW, 10);
            }
            w = w || 50;
            range.value = String(w);
            label.textContent = w + "%";

            // align active
            const a = img.dataset.align || 'center';
            document.getElementById('imgAlignLeft').classList.toggle('active', a === 'left');
            document.getElementById('imgAlignCenter').classList.toggle('active', a === 'center');
            document.getElementById('imgAlignRight').classList.toggle('active', a === 'right');
        }

        function deleteSelectedImage() {
            if (!__selectedImg) return;

            const img = __selectedImg;
            const editor = img.closest('[contenteditable="true"]');

            // Ambil node setelah img (kadang kita auto buat <p><br></p> setelah gambar)
            const next = img.nextSibling;

            // Hapus paragraf kosong setelah gambar jika ada
            // (case: <p><br></p> atau <p>&nbsp;</p> atau p kosong)
            if (next && next.nodeType === 1 && next.tagName === 'P') {
                const text = (next.textContent || '').replace(/\u00A0/g, '').trim();
                const html = (next.innerHTML || '').replace(/\u00A0/g, '').trim().toLowerCase();

                const isEmptyP =
                    text === '' &&
                    (html === '' || html === '<br>' || html === '<br/>' || html === '<br />');

                if (isEmptyP) next.remove();
            }

            // Hapus gambar
            img.remove();

            // Tutup toolbar & reset selected
            hideImageToolbar();

            // Fokuskan editor lagi biar user bisa lanjut ngetik
            if (editor) {
                editor.focus();

                // taruh caret di akhir editor
                const sel = window.getSelection();
                const range = document.createRange();
                range.selectNodeContents(editor);
                range.collapse(false);
                sel.removeAllRanges();
                sel.addRange(range);
            }

            showToast("Gambar berhasil dihapus", "success");
        }

        // ====== Text Settings Per Section ======
        let __bmSettingsOpenKey = null;

        function bmSectionKey(type, id) {
            return id ? `${type}:${id}` : `${type}`;
        }

        function bmEnsureFormats() {
            if (!ebookState.sectionFormats) ebookState.sectionFormats = {};
        }

        function bmGetFormat(type, id) {
            bmEnsureFormats();
            const key = bmSectionKey(type, id);
            const d = {
                align: 'justify',
                font: 'serif',
                lh: '1.7'
            };
            return {
                ...d,
                ...(ebookState.sectionFormats[key] || {})
            };
        }

        function bmFontCss(fontOpt) {
            if (fontOpt === 'sans') {
                return "'Inter', ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, sans-serif";
            }
            // serif
            return "'Merriweather','Times New Roman',serif";
        }

        function bmStyleAttr(type, id) {
            const f = bmGetFormat(type, id);
            const align = f.align || 'justify';
            const lh = f.lh || '1.7';
            const font = bmFontCss(f.font || 'serif');
            // pakai CSS variable -> tidak mengotori konten HTML di dalamnya
            return `style="--bm-align:${align};--bm-lh:${lh};--bm-font:${font};"`;
        }

        function bmFindEditor(type, id) {
            if (id) {
                return document.querySelector(
                    `.section-container[data-type="${type}"][data-id="${id}"] [contenteditable="true"]`);
            }
            return document.querySelector(`.section-container[data-type="${type}"] [contenteditable="true"]`);
        }

        function bmApplyFormatToDom(type, id) {
            const ed = bmFindEditor(type, id);
            if (!ed) return;

            const f = bmGetFormat(type, id);

            // ✅ buang inline align dulu supaya semua paragraf ikut
            bmStripInlineAlign(ed);

            ed.style.setProperty('--bm-align', f.align || 'justify');
            ed.style.setProperty('--bm-lh', f.lh || '1.7');
            ed.style.setProperty('--bm-font', bmFontCss(f.font || 'serif'));
        }


        function bmStripInlineAlign(ed) {
            if (!ed) return;
            ed.querySelectorAll('p,div,li,blockquote,h1,h2,h3,h4,h5,h6').forEach(el => {
                // hapus inline text-align
                if (el.style) el.style.removeProperty('text-align');

                // kalau style attribute kosong, hapus biar bersih
                const st = el.getAttribute('style');
                if (st && st.trim() === '') el.removeAttribute('style');
            });
        }


        function bmSaveFormat(type, id, patch) {
            bmEnsureFormats();
            const key = bmSectionKey(type, id);
            const now = bmGetFormat(type, id);
            ebookState.sectionFormats[key] = {
                ...now,
                ...patch
            };
            saveEbookState(); // simpan ke localStorage
            bmApplyFormatToDom(type, id); // apply langsung tanpa render ulang
        }

        function bmEnsurePopover() {
            let pop = document.getElementById('bm-settings-popover');
            if (pop) return pop;

            pop = document.createElement('div');
            pop.id = 'bm-settings-popover';
            pop.innerHTML = `
    <div class="bm-title">Pengaturan</div>

    <label>Perataan</label>
    <select id="bm_align">
      <option value="left">Rata Kiri</option>
      <option value="justify">Rata Kanan-Kiri (Justify)</option>
      <option value="center">Rata Tengah</option>
      <option value="right">Rata Kanan</option>
    </select>

    <label>Font</label>
    <select id="bm_font">
      <option value="sans">Sans Serif (Inter)</option>
      <option value="serif">Serif (Merriweather)</option>
    </select>

    <label>Spasi Baris</label>
    <select id="bm_lh">
      <option value="1.2">Rapat (1.2)</option>
      <option value="1.7">Normal (1.7)</option>
      <option value="2.0">Lebar (2.0)</option>
      <option value="2.5">Sangat Lebar (2.5)</option>
    </select>
  `;
            document.body.appendChild(pop);

            // jangan auto-close saat klik di dalam popover
            pop.addEventListener('click', (e) => e.stopPropagation());

            return pop;
        }

        function bmClosePopover() {
            const pop = document.getElementById('bm-settings-popover');
            if (pop) pop.style.display = 'none';
            __bmSettingsOpenKey = null;
        }

        function toggleTextSettings(e, type, id) {
            e.stopPropagation();
            const key = bmSectionKey(type, id || null);

            const pop = bmEnsurePopover();
            const f = bmGetFormat(type, id || null);

            // toggle
            if (pop.style.display === 'block' && __bmSettingsOpenKey === key) {
                bmClosePopover();
                return;
            }

            __bmSettingsOpenKey = key;

            // set current values
            pop.querySelector('#bm_align').value = f.align || 'justify';
            pop.querySelector('#bm_font').value = f.font || 'serif';
            pop.querySelector('#bm_lh').value = f.lh || '1.7';

            // attach change handlers (replace each time to ensure correct target)
            pop.querySelector('#bm_align').onchange = (ev) => bmSaveFormat(type, id || null, {
                align: ev.target.value
            });
            pop.querySelector('#bm_font').onchange = (ev) => bmSaveFormat(type, id || null, {
                font: ev.target.value
            });
            pop.querySelector('#bm_lh').onchange = (ev) => bmSaveFormat(type, id || null, {
                lh: ev.target.value
            });

            // position near button
            const rect = e.currentTarget.getBoundingClientRect();
            pop.style.display = 'block';

            // default: bawah tombol
            let top = rect.bottom + 8;
            let left = rect.left;

            // keep in viewport
            const popW = 230;
            const popH = 220;
            if (left + popW + 10 > window.innerWidth) left = window.innerWidth - popW - 10;
            if (top + popH + 10 > window.innerHeight) top = rect.top - popH - 8;

            pop.style.top = `${Math.max(10, top)}px`;
            pop.style.left = `${Math.max(10, left)}px`;
        }

        // close on outside click + ESC
        document.addEventListener('click', () => bmClosePopover());
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') bmClosePopover();
        });
    </script>

</body>

</html>
