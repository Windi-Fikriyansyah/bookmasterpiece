@extends('template.app')

@section('title', 'Ebook Masterpiece')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-xxl-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5 p-lg-6">

                    {{-- Judul --}}
                    <h3 class="fw-semibold mb-2">
                        1. Link Akses Aplikasi
                        <span class="text-primary">“Book Masterpiece AI”</span>
                    </h3>



                    {{-- Tombol Akses --}}
                    <a href="{{ route('bookmasterpiece.index') }}"
                        class="btn btn-primary btn-lg px-4 py-3 d-inline-flex align-items-center gap-2 mb-5">
                        <i class="ti ti-external-link fs-4"></i>
                        <span class="fw-medium fs-5">
                            Akses Book Masterpiece AI Versi Terbaru (3.0)
                        </span>
                    </a>

                    {{-- Alert Penting --}}
                    {{-- <div class="alert alert-danger border-start border-5 rounded-3 p-4 mb-5">
                        <p class="mb-0 fs-5">
                            Jika tulisan yang ada di <strong>kotak merah</strong> pada gambar tutorial
                            <strong>tidak muncul</strong> di aplikasi Anda,
                            berarti Anda masih menggunakan versi lama.
                            <br><br>
                            <strong>
                                Silakan klik ulang link di atas atau refresh halaman
                            </strong>
                            sampai versi terbaru tampil.
                        </p>
                    </div> --}}

                    {{-- Info Versi --}}
                    <div class="mb-5">
                        <h4 class="fw-semibold mb-3">
                            Book Masterpiece AI Versi 3.0
                        </h4>

                        <ul class="list-unstyled fs-5 ms-2">
                            <li class="mb-2">
                                <i class="ti ti-check text-success me-2"></i>
                                Bisa sisipkan bab baru antar bab
                            </li>
                            <li class="mb-2">
                                <i class="ti ti-check text-success me-2"></i>
                                Bisa regenerate berkali-kali oleh AI
                            </li>
                            <li class="mb-2">
                                <i class="ti ti-check text-success me-2"></i>
                                Bisa menambah judul bab secara manual
                            </li>
                            <li class="mb-2">
                                <i class="ti ti-check text-success me-2"></i>
                                Menggunakan update AI Google terbaru
                            </li>
                        </ul>
                    </div>

                    {{-- Peringatan --}}
                    {{-- <div class="alert alert-warning border-start border-5 rounded-3 p-4 mb-5">
                        <p class="mb-0 fs-5">
                            <strong>Tidak disarankan menggunakan versi lama</strong>
                            karena dapat menyebabkan error saat pembuatan konten ebook.
                            <br><br>
                            Wajib menggunakan
                            <strong>versi 3.0 (Update 19 November 2025)</strong>.
                        </p>
                    </div> --}}

                    {{-- Catatan --}}
                    <div class="border-top pt-4 mt-4">
                        <p class="mb-0 fs-5">
                            <strong>Catatan:</strong>
                            Akses Book Masterpiece AI diberikan secara eksklusif selama 30 hari untuk memastikan pengalaman
                            penggunaan yang optimal. Akun bersifat pribadi dan tidak diperkenankan untuk dibagikan, demi
                            menjaga kualitas layanan dan keamanan sistem.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
