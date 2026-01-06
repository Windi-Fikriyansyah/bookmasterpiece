@extends('template.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row">

        {{-- HERO / INTRO --}}
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">

                    <span class="badge bg-primary mb-3">
                        Platform AI Penulisan Buku
                    </span>

                    <h2 class="fw-bold mb-2">
                        <span class="text-primary">BOOK MASTERPIECE AI</span>
                    </h2>

                    <h5 class="text-muted mb-4">
                        Asisten Menulis Buku • Terstruktur • Siap Terbit
                    </h5>

                    <p class="text-muted mb-3">
                        <strong>Book Masterpiece AI</strong> adalah platform penulisan buku berbasis Artificial Intelligence
                        yang dirancang untuk membantu siapa pun — baik pemula maupun penulis berpengalaman —
                        menulis buku <strong>lebih cepat, lebih rapi, dan benar-benar selesai</strong>.
                    </p>

                    <p class="text-muted mb-3">
                        Anda tidak perlu bingung memulai dari mana. Sistem kami akan memandu Anda
                        dari tahap <strong>ide awal</strong>, <strong>penentuan judul</strong>,
                        <strong>penyusunan daftar isi</strong>, hingga penulisan
                        <strong>bab, subbab, penutup, daftar pustaka</strong>, dan <strong>profil penulis</strong>.
                    </p>

                    <p class="text-muted mb-4">
                        Seluruh proses dilakukan dalam satu dashboard terpadu,
                        dilengkapi editor teks, pengelolaan bab, sisip gambar,
                        serta <strong>AI Cover Generator</strong> untuk membuat tampilan buku
                        yang profesional dan siap diterbitkan.
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('ebook_master') }}" class="btn btn-primary">
                            🚀 Mulai Menulis Buku
                        </a>

                        <a href="{{ route('langganan') }}" class="btn btn-outline-primary">
                            💎 Lihat Paket & Fitur
                        </a>
                    </div>

                </div>
            </div>
        </div>

        {{-- UNTUK SIAPA --}}
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">📌 Cocok Untuk Siapa?</h5>
                    <ul class="text-muted mb-0">
                        <li>Penulis pemula yang ingin menulis buku pertama</li>
                        <li>Akademisi, guru, dosen, dan mahasiswa</li>
                        <li>Praktisi, coach, motivator, dan profesional</li>
                        <li>Content creator yang ingin naik kelas jadi penulis buku</li>
                        <li>Siapa pun yang ingin bukunya <strong>selesai & siap terbit</strong></li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- CARA KERJA --}}
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">🛠️ Cara Kerja Book Masterpiece AI</h5>

                    <div class="row g-3">
                        <div class="col-md-3">
                            <div class="border rounded p-3 h-100">
                                <h6 class="fw-semibold">1️⃣ Tentukan Konsep</h6>
                                <p class="text-muted mb-0">
                                    Tentukan tema, target pembaca, dan tujuan buku Anda.
                                </p>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="border rounded p-3 h-100">
                                <h6 class="fw-semibold">2️⃣ Susun Struktur</h6>
                                <p class="text-muted mb-0">
                                    AI membantu membuat judul, outline, dan daftar isi.
                                </p>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="border rounded p-3 h-100">
                                <h6 class="fw-semibold">3️⃣ Tulis & Edit</h6>
                                <p class="text-muted mb-0">
                                    Tulis per bab dengan editor yang rapi dan fleksibel.
                                </p>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="border rounded p-3 h-100">
                                <h6 class="fw-semibold">4️⃣ Siap Terbit</h6>
                                <p class="text-muted mb-0">
                                    Lengkapi cover, profil penulis, dan finalisasi naskah.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- FITUR UTAMA --}}
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avtar avtar-l bg-light-primary me-3">
                            <i class="ti ti-book text-primary"></i>
                        </div>
                        <h6 class="mb-0 fw-semibold">Penulisan Terstruktur</h6>
                    </div>
                    <p class="text-muted mb-0">
                        Alur penulisan jelas dari awal hingga buku benar-benar selesai.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avtar avtar-l bg-light-success me-3">
                            <i class="ti ti-photo text-success"></i>
                        </div>
                        <h6 class="mb-0 fw-semibold">AI Cover Generator</h6>
                    </div>
                    <p class="text-muted mb-0">
                        Buat cover buku profesional tanpa desainer (bonus paket tertentu).
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avtar avtar-l bg-light-info me-3">
                            <i class="ti ti-users text-info"></i>
                        </div>
                        <h6 class="mb-0 fw-semibold">Komunitas & Tutorial</h6>
                    </div>
                    <p class="text-muted mb-0">
                        Akses video tutorial, grup diskusi, dan panduan penulisan.
                    </p>
                </div>
            </div>
        </div>

    </div>
@endsection
