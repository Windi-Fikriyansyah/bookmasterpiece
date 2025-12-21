@extends('template.app')

@section('title', 'Bonus Ebook Cover Masterpiece')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-xxl-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5 p-lg-6">

                    {{-- Judul --}}
                    <h2 class="fw-bold mb-2">
                        2. Link Akses Aplikasi BONUS
                        <span class="text-primary">Book Cover Masterpiece”</span>
                    </h2>

                    {{-- Last Updated --}}
                    {{-- <p class="text-muted fs-6 mb-5">
                        Last updated:
                        <strong>31 Oktober 2025, 01:15</strong>
                    </p> --}}

                    {{-- Tombol Akses --}}
                    <a href="https://gemini.google.com/share/ce0239c238a1" target="_blank"
                        class="btn btn-primary btn-lg px-4 py-3 d-inline-flex align-items-center gap-2 mb-5">
                        <i class="ti ti-palette fs-4"></i>
                        <span class="fw-semibold">
                            Klik di sini untuk mengakses Book Cover Masterpiece
                        </span>
                    </a>



                </div>
            </div>
        </div>
    </div>
@endsection
