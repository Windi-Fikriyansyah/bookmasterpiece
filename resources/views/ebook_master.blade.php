@extends('template.app')

@section('title', 'Ebook Masterpiece')

@section('content')
    <div class="row justify-content-center">
        {{-- Lebih lebar --}}
        <div class="col-12 col-xxl-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5 p-lg-6">

                    {{-- Judul --}}
                    <h2 class="fw-bold mb-2">
                        1. Link Akses Aplikasi
                        <span class="text-primary">“Ebook Masterpiece”</span>
                    </h2>

                    {{-- Last Updated --}}
                    <p class="text-muted fs-6 mb-5">
                        Last updated:
                        <strong>19 November 2025, 15:19</strong>
                    </p>

                    {{-- Tombol Akses --}}
                    <a href="{{ route('bookmasterpiece.index') }}"
                        class="btn btn-primary btn-lg px-4 py-3 d-inline-flex align-items-center gap-2 mb-5">
                        <i class="ti ti-external-link fs-4"></i>
                        <span class="fw-semibold">
                            Akses Ebook Masterpiece Versi Terbaru (3.0)
                        </span>
                    </a>

                    {{-- Alert Penting --}}
                    <div class="alert alert-danger border-start border-5 rounded-3 p-4 mb-5">
                        <p class="mb-0 fs-6">
                            Jika tulisan yang ada di <strong>kotak merah</strong> pada gambar tutorial
                            <strong>tidak muncul</strong> di aplikasi Anda,
                            berarti Anda masih menggunakan versi lama.
                            <br><br>
                            <strong>
                                Silakan klik ulang link di atas atau refresh halaman
                            </strong>
                            sampai versi terbaru tampil.
                        </p>
                    </div>

                    {{-- Info Versi --}}
                    <div class="mb-5">
                        <h4 class="fw-semibold mb-3">
                            Versi Terbaru (3.0) – Update 19 November 2025
                        </h4>

                        <ul class="list-unstyled fs-6 ms-2">
                            <li class="mb-3">
                                <i class="ti ti-check text-success me-2"></i>
                                Bisa sisipkan bab baru antar bab
                            </li>
                            <li class="mb-3">
                                <i class="ti ti-check text-success me-2"></i>
                                Bisa regenerate berkali-kali oleh AI
                            </li>
                            <li class="mb-3">
                                <i class="ti ti-check text-success me-2"></i>
                                Bisa menambah judul bab secara manual
                            </li>
                            <li class="mb-3">
                                <i class="ti ti-check text-success me-2"></i>
                                Menggunakan update AI Google terbaru
                            </li>
                        </ul>
                    </div>

                    {{-- Peringatan --}}
                    <div class="alert alert-warning border-start border-5 rounded-3 p-4 mb-5">
                        <p class="mb-0 fs-6">
                            <strong>Tidak disarankan menggunakan versi lama</strong>
                            karena dapat menyebabkan error saat pembuatan konten ebook.
                            <br><br>
                            Wajib menggunakan
                            <strong>versi 3.0 (Update 19 November 2025)</strong>.
                        </p>
                    </div>

                    {{-- Catatan --}}
                    <div class="border-top pt-4 mt-4">
                        <p class="mb-0 fs-6">
                            <strong>Catatan:</strong>
                            Untuk menghindari kebingungan,
                            <strong>wajib menonton tutorial versi terbaru</strong>.
                            <br>
                            Video tersedia di modul
                            <strong>“Tutorial Penggunaan”</strong>,
                            video nomor <strong>10</strong>.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
