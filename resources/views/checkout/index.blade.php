<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Checkout Pembayaran</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .checkout-card {
            max-width: 420px;
            margin: auto;
            border-radius: 16px;
        }

        .form-control {
            height: 46px;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <div class="card shadow-sm border-0 checkout-card">
            <div class="card-body p-4">

                <!-- Header -->
                <div class="text-center mb-4">
                    <h4 class="fw-bold mb-1">Checkout Pembayaran</h4>
                    <p class="text-muted mb-0">
                        Lengkapi data untuk melanjutkan pembayaran
                    </p>
                </div>
                @if (session('error'))
                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            const toast = document.createElement('div');
                            toast.className =
                                'toast show position-fixed top-0 start-50 translate-middle-x mt-3 bg-danger text-white';
                            toast.innerHTML = `
            <div class="toast-body">
                ${@json(session('error'))}
            </div>`;
                            document.body.appendChild(toast);
                            setTimeout(() => toast.remove(), 3000);
                        });
                    </script>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('checkout.process') }}">
                    @csrf

                    <input type="hidden" name="package_id" value="{{ $package->id }}">

                    <!-- Nama -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Nama Lengkap
                        </label>
                        <input type="text" name="name" class="form-control rounded-3"
                            placeholder="Masukkan nama lengkap" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Email
                        </label>
                        <input type="email" name="email" class="form-control rounded-3"
                            placeholder="contoh@email.com" required>
                    </div>

                    <!-- WhatsApp -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            No WhatsApp
                        </label>
                        <input type="text" name="phone" class="form-control rounded-3" placeholder="08xxxxxxxxxx"
                            required>
                        <small class="text-muted">
                            Nomor ini digunakan untuk konfirmasi & invoice
                        </small>
                    </div>

                    <!-- Button -->
                    <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-semibold">
                        Lanjutkan Pembayaran →
                    </button>
                </form>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
