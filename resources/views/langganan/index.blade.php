@extends('template.app')

@section('title', 'Langganan')

@section('content')
    <div class="row justify-content-center pb-5">
        <div class="col-12 col-xxl-11">

            {{-- Header --}}
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-2">
                    Pilih Paket Book Masterpiece AI
                </h2>
                <h3 class="fw-bold text-primary mb-1">
                    BOOK MASTERPIECE AI
                </h3>
                <p class="text-muted fs-6">
                    Asisten Menulis Buku Anda – <strong>Siap Terbit</strong>
                </p>
            </div>

            {{-- Paket --}}
            <div class="row g-4 justify-content-center">
                @foreach ($packages as $paket)
                    <div class="col-md-6 col-lg-4">
                        <div
                            class="card border-0 shadow-sm h-100 rounded-4 {{ $paket->is_featured ? 'shadow-lg' : '' }} position-relative">

                            @if ($paket->badge)
                                <span
                                    class="badge bg-primary position-absolute top-0 start-50 translate-middle px-4 py-2 rounded-pill">
                                    {{ $paket->badge }}
                                </span>
                            @endif

                            <div class="card-body p-5 text-center d-flex flex-column">

                                <h4 class="fw-bold mb-2 text-uppercase">{{ $paket->name }}</h4>
                                <p class="text-muted mb-3">{{ $paket->description }}</p>

                                <h2 class="fw-bold mb-1">
                                    Rp{{ number_format($paket->price, 0, ',', '.') }}
                                </h2>

                                @if ($paket->price_original)
                                    <p class="text-muted mb-4">
                                        <del>Rp{{ number_format($paket->price_original, 0, ',', '.') }}</del> /
                                        {{ $paket->duration }}
                                    </p>
                                @else
                                    <p class="text-muted mb-4">/{{ $paket->duration }}</p>
                                @endif

                                <ul class="list-unstyled text-start mb-4">
                                    @foreach ($paket->features as $fitur)
                                        <li
                                            class="mb-2 d-flex align-items-start {{ $fitur->is_bonus ? 'fw-semibold text-primary' : '' }}">
                                            <span class="me-2">{{ $fitur->is_bonus ? '🎁' : '✅' }}</span>
                                            <span>{{ $fitur->feature_text }}</span>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="mt-auto">
                                    @auth
                                        {{-- USER LOGIN → PERPANJANG --}}
                                        <a href="{{ route('checkout.renew', $paket->slug) }}"
                                            class="btn {{ $paket->button_class }} btn-lg w-100">
                                            {{ $paket->button_text }}
                                        </a>
                                    @else
                                        {{-- USER BARU --}}
                                        <a href="{{ route('checkout.index', $paket->slug) }}"
                                            class="btn {{ $paket->button_class }} btn-lg w-100">
                                            {{ $paket->button_text }}
                                        </a>
                                    @endauth


                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
