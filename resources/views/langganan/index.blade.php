@extends('template.app')

@section('title', 'Langganan')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-xxl-10">

            {{-- Header --}}
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-2">
                    Pilih Paket <span class="text-primary">Langganan</span>
                </h2>
                <p class="text-muted fs-6">
                    Dapatkan akses penuh ke <strong>Book Masterpiece AI</strong> sesuai kebutuhanmu
                </p>
            </div>

            {{-- Paket --}}
            <div class="row g-4">

                {{-- Paket Bulanan --}}
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100 rounded-4">
                        <div class="card-body p-5 text-center d-flex flex-column">

                            <div class="mb-3">
                                <span class="avtar avtar-xl bg-light-primary text-primary">
                                    <i class="ti ti-calendar fs-2"></i>
                                </span>
                            </div>

                            <h4 class="fw-bold mb-2">Paket Bulanan</h4>
                            <p class="text-muted mb-4">
                                Cocok untuk coba fitur dan penggunaan jangka pendek
                            </p>

                            <h2 class="fw-bold mb-4">
                                Rp49.000
                                <span class="fs-6 text-muted fw-normal">/bulan</span>
                            </h2>

                            <ul class="list-unstyled text-start mb-4">
                                <li class="mb-2">
                                    <i class="ti ti-check text-success me-2"></i>
                                    Akses penuh Book Masterpiece AI
                                </li>
                                <li class="mb-2">
                                    <i class="ti ti-check text-success me-2"></i>
                                    Generate book tanpa batas
                                </li>
                                <li class="mb-2">
                                    <i class="ti ti-check text-success me-2"></i>
                                    Update fitur otomatis
                                </li>
                                <li class="mb-2">
                                    <i class="ti ti-check text-success me-2"></i>
                                    Support standar
                                </li>
                            </ul>

                            <div class="mt-auto">
                                <a href="" class="btn btn-outline-primary btn-lg w-100">
                                    Pilih Paket Bulanan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Paket Tahunan --}}
                <div class="col-md-6">
                    <div class="card border-0 shadow-lg h-100 rounded-4 position-relative">

                        {{-- Badge Rekomendasi --}}
                        <span
                            class="badge bg-primary position-absolute top-0 start-50 translate-middle px-4 py-2 rounded-pill">
                            PALING HEMAT
                        </span>

                        <div class="card-body p-5 text-center d-flex flex-column">

                            <div class="mb-3">
                                <span class="avtar avtar-xl bg-light-success text-success">
                                    <i class="ti ti-crown fs-2"></i>
                                </span>
                            </div>

                            <h4 class="fw-bold mb-2">Paket Tahunan</h4>
                            <p class="text-muted mb-4">
                                Hemat lebih besar untuk penggunaan jangka panjang
                            </p>

                            <h2 class="fw-bold mb-1">
                                Rp150.000
                            </h2>
                            <p class="text-muted mb-4">
                                <del>Rp300.000</del> / tahun
                            </p>

                            <ul class="list-unstyled text-start mb-4">
                                <li class="mb-2">
                                    <i class="ti ti-check text-success me-2"></i>
                                    Semua fitur paket bulanan
                                </li>
                                <li class="mb-2">
                                    <i class="ti ti-check text-success me-2"></i>
                                    Lebih hemat hingga 15%
                                </li>
                                <li class="mb-2">
                                    <i class="ti ti-check text-success me-2"></i>
                                    Prioritas update fitur
                                </li>
                                <li class="mb-2">
                                    <i class="ti ti-check text-success me-2"></i>
                                    Priority support
                                </li>
                            </ul>

                            <div class="mt-auto">
                                <a href="" class="btn btn-primary btn-lg w-100">
                                    Pilih Paket Tahunan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Footer Info --}}
            <div class="text-center mt-5">

            </div>

        </div>
    </div>
@endsection
