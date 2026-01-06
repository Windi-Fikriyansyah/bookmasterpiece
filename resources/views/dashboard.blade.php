@extends('template.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row">

        {{-- HERO / MAIN CONTENT --}}
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <h2 class="fw-bold mb-2">
                        <span class="text-primary">BOOK MASTERPIECE AI</span>
                    </h2>

                    <h5 class="text-muted mb-3">
                        Asisten Menulis Buku • <span class="fw-semibold">Siap Terbit</span>
                    </h5>

                    <p class="text-muted mb-3">
                        <strong>Book Masterpiece AI</strong> adalah aplikasi menulis buku berbasis AI
                        yang dirancang khusus untuk membantu Anda menulis buku dengan mudah,
                        cepat, dan benar-benar selesai — bahkan untuk pemula.
                    </p>

                    <p class="text-muted mb-3">
                        Mulai dari menentukan <strong>judul</strong>, menyusun <strong>daftar isi</strong>,
                        menulis <strong>pengantar</strong>, <strong>bab & subbab</strong>,
                        hingga <strong>penutup</strong>, <strong>daftar pustaka</strong>,
                        dan <strong>profil penulis</strong>, semuanya dipandu secara sistematis
                        dalam satu aplikasi.
                    </p>

                    <p class="text-muted mb-4">
                        Dilengkapi fitur <strong>edit teks</strong>, <strong>tambah bab</strong>,
                        <strong>sisipkan gambar</strong>, serta <strong>aplikasi gratis pembuat cover buku</strong>.
                        Didukung video tutorial step-by-step dan formula penulisan teruji
                        agar proses menulis lebih terarah dan siap terbit.
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('ebook_master') }}" class="btn btn-primary">
                            Mulai Menulis Buku
                        </a>

                        <a href="{{ route('langganan') }}" class="btn btn-outline-primary">
                            Lihat Paket & Fitur
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- FITUR RINGKAS --}}
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
                        Alur menulis dari nol hingga buku selesai, dipandu langkah demi langkah.
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
                        <h6 class="mb-0 fw-semibold">Cover Buku AI</h6>
                    </div>
                    <p class="text-muted mb-0">
                        Buat cover buku profesional berbasis AI (bonus paket tertentu).
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
                        Akses grup eksklusif, diskusi, dan video tutorial penulisan.
                    </p>
                </div>
            </div>
        </div>

        {{-- STATUS AKUN --}}
        <div class="col-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-bold mb-1">Status Akun</h6>
                        <p class="mb-0 text-muted">
                            Paket Aktif:
                            <strong class="text-primary">
                                {{ ucfirst(optional($activeSubscription)->duration ?? 'Gratis') }}
                            </strong>
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('langganan') }}" class="btn btn-outline-primary btn-sm">
                            Kelola Langganan
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- INFO LEGAL --}}
        <div class="col-12">
            <div class="alert alert-light border">
                <small class="text-muted">
                    Dengan menggunakan <strong>Book Masterpiece AI</strong>,
                    Anda menyetujui
                    <a href="{{ route('terms') }}">Ketentuan Layanan</a> dan
                    <a href="{{ route('privacy') }}">Kebijakan Privasi</a>.
                </small>
            </div>
        </div>

    </div>
@endsection
