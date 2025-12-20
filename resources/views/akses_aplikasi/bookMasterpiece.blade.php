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
    </style>
</head>

<body class="bg-[#eef3f8] font-sans">

    <!-- Header -->
    <div class="text-center py-8">
        <h1 class="text-4xl font-bold text-gray-800">Book Masterpiece AI</h1>
        <p class="text-gray-500 mt-2">
            Dari Masalah Nyata Menjadi Karya Buku yang Siap Terbit.
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
                        <input type="text" id="api_key_input"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            placeholder="Masukkan API Key Anda di sini">

                        <button id="save_api_key"
                            class="mt-3 w-full bg-green-600 text-white py-2 rounded-lg text-sm hover:bg-green-700 transition-colors duration-200">
                            <i class="fas fa-save mr-2"></i>Simpan API Key
                        </button>
                    </div>

                    <div>
                        <label class="text-sm font-medium block mb-1">Jelaskan Masalah Anda:</label>
                        <textarea rows="4" id="masalah_input"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            placeholder="Contoh: Saya kesulitan fokus saat bekerja…"></textarea>
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
                            <label class="text-sm font-medium block mb-1">Jumlah Bab Awal:</label>
                            <input id="jumlah_bab_input" type="number" value="3" min="1" max="20"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-medium block mb-1">Tentang Penulis (Opsional):</label>
                        <textarea rows="2" id="penulis_input"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            placeholder="Tulis bio singkat Anda di sini."></textarea>
                    </div>
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
                        Buat Judul Book
                    </button>

                    <button onclick="generateEbook('intro')"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg text-sm hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center gap-2">
                        <i class="fas fa-book-open"></i>
                        Buat Pendahuluan
                    </button>

                    {{-- <button onclick="generateEbook('outline')"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg text-sm hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center gap-2">
                        <i class="fas fa-list-ol"></i>
                        Buat Daftar Isi
                    </button> --}}

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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

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
            intro: null,
            outline: null,
            chapters: [],
            summary: null,
            closing: null,
            manualSections: []
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
            const inputs = ['masalah_input', 'gaya_input', 'jumlah_bab_input', 'penulis_input'];

            inputs.forEach(inputId => {
                const element = document.getElementById(inputId);
                if (element) {
                    element.addEventListener('input', () => {
                        saveFormData();
                        updateStats();
                    });
                    element.addEventListener('change', () => {
                        saveFormData();
                        updateStats();
                    });
                }
            });
        }

        function saveFormData() {
            const formData = {
                masalah: document.getElementById("masalah_input").value,
                gaya: document.getElementById("gaya_input").value,
                jumlah_bab: document.getElementById("jumlah_bab_input").value,
                penulis: document.getElementById("penulis_input").value
            };

            localStorage.setItem('ebook_form_data', JSON.stringify(formData));
        }

        function loadFormData() {
            const savedData = localStorage.getItem('ebook_form_data');
            if (savedData) {
                const formData = JSON.parse(savedData);
                document.getElementById("masalah_input").value = formData.masalah || '';
                document.getElementById("gaya_input").value = formData.gaya ||
                    'Profesional & Formal (Resmi, kredibel, berjarak)';
                document.getElementById("jumlah_bab_input").value = formData.jumlah_bab || 3;
                document.getElementById("penulis_input").value = formData.penulis || '';
            }
        }

        function loadEbookState() {
            const savedState = localStorage.getItem('ebook_state');
            if (savedState) {
                ebookState = JSON.parse(savedState);

                // FIX: jika daftar chapter tidak cocok dengan tampilan, reset
                if (!ebookState.chapters || ebookState.chapters.length === 0) {
                    ebookState.chapters = [];
                }

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
                ebookState.intro,
                ebookState.outline,
                ebookState.summary,
                ebookState.closing,
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

        function getFormValues() {
            return {
                masalah: document.getElementById("masalah_input").value,
                gaya: document.getElementById("gaya_input").value,
                jumlah_bab: document.getElementById("jumlah_bab_input").value || 3,
                penulis: document.getElementById("penulis_input").value
            };
        }

        function extractChapterTitles() {
            const titles = [];

            // Ambil dari daftar isi jika ada
            if (ebookState.outline) {
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = ebookState.outline;

                const listItems = tempDiv.querySelectorAll('li');
                listItems.forEach(li => {
                    const text = li.textContent.trim();
                    titles.push(text);
                });
            }

            // Juga ambil dari bab yang sudah ada
            ebookState.chapters.forEach(chapter => {
                if (chapter.title) {
                    const titleText = `Bab ${chapter.chapterNumber}: ${chapter.title}`;
                    // Cek apakah sudah ada di array
                    if (!titles.some(t => t.includes(`Bab ${chapter.chapterNumber}`))) {
                        titles.push(titleText);
                    }
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

            if (!val.masalah.trim()) {
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
                const currentChapterCount = ebookState.chapters.length; // Ambil jumlah bab yang sudah ada
                const chapterTitles = extractChapterTitles();

                // Tentukan nomor bab selanjutnya
                const nextChapterNumber = currentChapterCount + 1;

                // Jika membuat bab baru (action === 'chapter')
                if (action === "chapter") {
                    // Cek apakah bab ini sudah ada di daftar isi
                    const tocItem = chapterTitles.find(title => title.includes(`Bab ${nextChapterNumber}`));

                    const response = await fetch("/ebook/generate", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            action: action,
                            masalah: val.masalah,
                            gaya: val.gaya,
                            jumlah_bab: val.jumlah_bab,
                            penulis: val.penulis,
                            existing_title: ebookState.title || "",
                            current_chapter_count: currentChapterCount,
                            chapter_titles: chapterTitles,
                            target_chapter: nextChapterNumber // Gunakan nextChapterNumber yang sudah dihitung
                        })
                    });

                    const result = await response.json();

                    if (!result.status) {
                        showToast(result.message, "error");
                        return;
                    }

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
                        content: result.html,
                        type: "chapter",
                        chapterNumber: nextChapterNumber, // Gunakan nomor yang benar
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

                // Untuk action lainnya (title, intro, dll)
                const response = await fetch("/ebook/generate", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        action: action,
                        masalah: val.masalah,
                        gaya: val.gaya,
                        jumlah_bab: val.jumlah_bab,
                        penulis: val.penulis,
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

        function getNextChapterNumber() {
            return ebookState.chapters.length + 1;
        }

        function updateOutlineAfterChapterChange() {
            // Pastikan bab diurutkan berdasarkan nomor
            ebookState.chapters.sort((a, b) => a.chapterNumber - b.chapterNumber);

            // Update judul dari konten jika ada perubahan
            ebookState.chapters.forEach(chapter => {
                if (chapter.content) {
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = chapter.content;
                    const h2 = tempDiv.querySelector('h2');

                    if (h2) {
                        const text = h2.textContent.trim();
                        const match = text.match(/Bab\s+\d+:\s*(.+)/i);
                        if (match && match[1]) {
                            chapter.title = match[1].trim();
                        } else {
                            // Format alternatif
                            const altMatch = text.match(/(?:BAB|Bab|bab)\s+\d+\s*[:\.]?\s*(.+)/i);
                            if (altMatch && altMatch[1]) {
                                chapter.title = altMatch[1].trim();
                            }
                        }
                    }
                }
            });

            // Buat daftar isi baru
            if (ebookState.chapters.length > 0) {
                let html = `<h2>Daftar Isi</h2><ol>`;

                ebookState.chapters.forEach(chapter => {
                    const title = chapter.title || `Bab ${chapter.chapterNumber}`;
                    html += `<li>Bab ${chapter.chapterNumber}: ${title}</li>`;
                });

                html += `</ol>`;
                ebookState.outline = html;
            } else {
                ebookState.outline = null;
            }

            // Langsung save state
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
                'intro': 'Pendahuluan',
                'outline': 'Daftar isi',
                'summary': 'Ringkasan',
                'closing': 'Penutup'
            };
            return names[action] || 'Konten';
        }

        function updateEbookState(action, html) {
            switch (action) {
                case 'title':
                    ebookState.title = html;
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
                    ebookState.closing = html;
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
            <div contenteditable="true" onfocus="showActions(this)" onblur="saveEditedSection('title', this.innerHTML)"
                 class="outline-none cursor-text">
                ${ebookState.title}
            </div>
        </div>`;
            }

            // Render pendahuluan jika ada
            if (ebookState.intro) {
                html += `
        <div class="section-container" data-type="intro">
            ${addActionButtons('intro', null)}
            <div contenteditable="true" onfocus="showActions(this)" onblur="saveEditedSection('intro', this.innerHTML)"
                 class="outline-none cursor-text">
                ${ebookState.intro}
            </div>
        </div>`;
            }

            // Render daftar isi jika ada - INI YANG PENTING
            if (ebookState.outline) {
                html += `
        <div class="section-container toc-container" data-type="outline">
            ${addActionButtons('outline', null)}
            <div contenteditable="true" onfocus="showActions(this)" onblur="saveEditedSection('outline', this.innerHTML)"
                 class="outline-none cursor-text">
                ${ebookState.outline}
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
            <div contenteditable="true" onfocus="showActions(this)"
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
            <div contenteditable="true" onfocus="showActions(this)"
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
            <div contenteditable="true" onfocus="showActions(this)" onblur="saveEditedSection('summary', this.innerHTML)"
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
            <div contenteditable="true" onfocus="showActions(this)" onblur="saveEditedSection('closing', this.innerHTML)"
                 class="outline-none cursor-text">
                ${ebookState.closing}
            </div>
        </div>`;
            }

            contentEl.innerHTML = html;
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



            if (type === 'chapter') {
                buttons += `
                <button onclick="insertChapterAfter('${id}')"
                        class="px-3 py-1 bg-purple-500 text-white rounded text-sm hover:bg-purple-600 transition-colors duration-200">
                    <i class="fas fa-plus mr-1"></i> Sisipkan Bab
                </button>
                `;
            }

            if (type !== 'manual') {
                buttons += `
                <button onclick="regenerateSection('${type}', '${id}')"
                        class="px-3 py-1 bg-blue-500 text-white rounded text-sm hover:bg-blue-600 transition-colors duration-200">
                    <i class="fas fa-sync-alt mr-1"></i> Regenerate
                </button>
                `;
            }

            buttons += `
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
                        gaya: val.gaya,
                        jumlah_bab: val.jumlah_bab,
                        penulis: val.penulis,
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


        function saveManualSection(id, content) {
            const section = ebookState.manualSections.find(s => s.id === id);
            if (section) {
                section.content = content;
                saveEbookState();
                showToast("Perubahan disimpan", "success");
            }
        }

        function saveEditedSection(type, content, id = null) {
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
                    intro: null,
                    outline: null,
                    chapters: [],
                    summary: null,
                    closing: null,
                    manualSections: []
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
                'intro': 'Pendahuluan',
                'outline': 'Daftar Isi',
                'chapter': 'Bab Baru',
                'summary': 'Ringkasan',
                'closing': 'Penutup'
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
    </script>

</body>

</html>
