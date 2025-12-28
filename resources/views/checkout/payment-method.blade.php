<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pilih Metode Pembayaran</title>

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .cursor-pointer {
            cursor: pointer;
        }

        .pay-item {
            transition: .15s ease-in-out;
        }

        .pay-item:hover {
            background: #f8f9fa;
        }

        /* kasih jarak radio & rapikan */
        .pay-item input[type="radio"] {
            transform: scale(1.1);
        }

        /* highlight saat kepilih */
        .pay-item:has(input[type="radio"]:checked) {
            border-color: #0d6efd !important;
            box-shadow: 0 0 0 .2rem rgba(13, 110, 253, .15);
            background: #f6f9ff;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="card mx-auto shadow-sm border-0" style="max-width:520px">
            <div class="card-body p-4 p-md-5">

                <h5 class="fw-bold mb-3 text-center">Pilih Metode Pembayaran</h5>
                <p class="text-muted text-center mb-4" style="font-size:14px">
                    Silakan pilih metode pembayaran yang kamu inginkan, lalu lanjutkan pembayaran.
                </p>

                {{-- Alert error (opsional) --}}
                @if ($errors->any())
                    <div class="alert alert-danger py-2">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li style="font-size:14px">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('checkout.pay') }}">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $orderId }}">

                    <div class="d-grid gap-2">
                        @foreach ($channels as $channel)
                            <label class="pay-item d-flex align-items-center border rounded-3 p-3 cursor-pointer">
                                <input class="form-check-input m-0" type="radio" name="method"
                                    value="{{ $channel['code'] }}" required>

                                <img src="{{ $channel['icon_url'] }}" class="mx-3" height="30"
                                    alt="{{ $channel['name'] }}">

                                <div class="w-100">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <strong class="d-block">{{ $channel['name'] }}</strong>
                                        <span class="badge text-bg-light border ms-2">
                                            {{ $channel['code'] }}
                                        </span>
                                    </div>

                                </div>
                            </label>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-4 py-2 fw-semibold">
                        Bayar Sekarang →
                    </button>

                    <div class="text-center mt-3">
                        <small class="text-muted">
                            Dengan melanjutkan, kamu menyetujui proses pembayaran sesuai metode yang dipilih.
                        </small>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- Bootstrap JS (opsional) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
