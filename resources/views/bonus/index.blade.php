@extends('template.app')

@section('title', 'Bonus')

@section('content')
    <div class="row g-4">

        @forelse ($bonuses as $bonus)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body p-4 text-center d-flex flex-column">

                        <div class="mb-3">
                            <i class="{{ $bonus->icon }} fs-1 text-primary"></i>
                        </div>

                        <h5 class="fw-bold mb-2">{{ $bonus->title }}</h5>
                        <p class="text-muted mb-4">{{ $bonus->desc }}</p>

                        <div class="mt-auto">
                            <a href="{{ route('bonus.view', $bonus->slug) }}" target="_blank" class="btn btn-primary w-100">
                                Lihat Bonus
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                Belum ada bonus tersedia
            </div>
        @endforelse

    </div>
@endsection
