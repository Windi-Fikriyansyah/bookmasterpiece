@extends('template.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row">

        {{-- WELCOME --}}
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h4 class="fw-bold mb-1">
                        Selamat Datang di <span class="text-primary">Book Masterpiece AI</span>
                    </h4>
                    <p class="text-muted mb-0">
                        Platform AI untuk membantu Anda membuat buku digital secara cepat,
                        profesional, dan terstruktur.
                    </p>
                </div>
            </div>
        </div>

        {{-- RINGKASAN FITUR --}}
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avtar avtar-l bg-light-primary me-3">
                            <i class="ti ti-book text-primary"></i>
                        </div>
                        <h5 class="mb-0 fw-semibold">Book Masterpiece AI</h5>
                    </div>
                    <p class="text-muted">
                        Buat naskah ebook dan buku secara otomatis dengan bantuan AI.
                    </p>
                    <a href="{{ route('ebook_master') }}" class="btn btn-primary btn-sm">
                        Buka Aplikasi
                    </a>
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
                        <h5 class="mb-0 fw-semibold">Book Cover Masterpiece</h5>
                    </div>
                    <p class="text-muted">
                        Buat desain cover buku profesional berbasis AI (bonus paket tertentu).
                    </p>

                    @if (in_array(optional($activeSubscription)->duration, ['tahun', 'lifetime']))
                        <a href="{{ route('cover_master') }}" class="btn btn-success btn-sm">
                            Buka Fitur
                        </a>
                    @else
                        <span class="badge bg-light-warning text-warning">
                            Upgrade Paket
                        </span>
                    @endif
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
                        <h5 class="mb-0 fw-semibold">Grup Eksklusif</h5>
                    </div>
                    <p class="text-muted">
                        Akses komunitas pengguna untuk diskusi, update, dan tips penulisan.
                    </p>
                    <a href="{{ route('group.index') }}" class="btn btn-info btn-sm">
                        Lihat Grup
                    </a>
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
