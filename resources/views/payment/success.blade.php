<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pembayaran Berhasil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #0d6efd, #0aa2c0);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background: #fff;
            width: 100%;
            max-width: 480px;
            padding: 40px 30px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .15);
            animation: fadeIn .6s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .icon {
            width: 90px;
            height: 90px;
            background: #e8f5e9;
            color: #2e7d32;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 42px;
            margin: 0 auto 20px;
        }

        h1 {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #111;
        }

        p {
            font-size: 15px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .info {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 15px;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .info strong {
            display: block;
            margin-bottom: 6px;
            color: #333;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            background: #0d6efd;
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            transition: .3s;
        }

        .btn:hover {
            background: #0b5ed7;
        }

        .footer {
            margin-top: 20px;
            font-size: 13px;
            color: #777;
        }
    </style>
</head>

<body>

    <div class="card">
        <div class="icon">
            <i class="fa-solid fa-check"></i>
        </div>

        <h1>Pembayaran Berhasil 🎉</h1>

        <p>
            Terima kasih telah berlangganan <strong>Book Masterpiece AI</strong>.<br>
            Akses akun Anda telah <strong>AKTIF</strong>.
        </p>

        <div class="info">
            <strong>Apa Selanjutnya?</strong>
            • Login ke dashboard<br>
            • Gunakan semua fitur premium<br>
            • Nikmati bonus eksklusif
        </div>

        <a href="{{ route('dashboard') }}" class="btn">
            Masuk ke Dashboard
        </a>

        <div class="footer">
            Salam Literasi ✍️<br>
            Tim Book Masterpiece AI
        </div>
    </div>

</body>

</html>
