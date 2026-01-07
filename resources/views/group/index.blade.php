@extends('template.app')

@section('title', 'Link Grup')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-5 text-center">

                    <h3 class="fw-bold mb-2">Komunitas Book Masterpiece AI</h3>
                    <p class="text-muted mb-4">
                        Bergabunglah dengan komunitas pengguna untuk mendapatkan
                        update, diskusi, dan bonus eksklusif.
                    </p>

                    <div class="d-grid gap-3">

                        {{-- GRUP EKSKLUSIF (SEMUA LANGGANAN AKTIF) --}}
                        @if ($subscription->duration === 'bulan')
                            <a href="https://chat.whatsapp.com/L1Bsh2TRpTELyfe5qwqrPN" target="_blank"
                                class="btn btn-outline-success btn-lg d-flex align-items-center justify-content-center gap-2">
                                <i class="ti ti-users"></i>
                                Masuk Grup Exclusive
                            </a>
                        @endif

                        @if ($subscription->duration === 'tahun')
                            <a href="https://chat.whatsapp.com/GcKd1lsZBQUC7AjdFQbL61" target="_blank"
                                class="btn btn-outline-success btn-lg d-flex align-items-center justify-content-center gap-2">
                                <i class="ti ti-users"></i>
                                Masuk Grup Executive
                            </a>
                        @endif

                        {{-- GRUP PREMIUM (HANYA TAHUNAN) --}}
                        @if ($subscription->duration === 'lifetime')
                            <a href="https://chat.whatsapp.com/Fp6KqGkMcpSB4YjWhXZFsA" target="_blank"
                                class="btn btn-warning btn-lg d-flex align-items-center justify-content-center gap-2">
                                <i class="ti ti-crown"></i>
                                Masuk Grup Premium
                            </a>
                        @else
                            <div class="alert alert-info mt-3">
                                <i class="ti ti-info-circle"></i>
                                Grup Premium hanya tersedia untuk
                                <strong>langganan Lifetime</strong>.
                            </div>
                        @endif

                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
