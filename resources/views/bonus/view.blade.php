<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $bonus->title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fa;
        }

        .card {
            border: none;
        }

        iframe {
            background-color: #fff;
        }
    </style>
</head>

<body>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">

                <div class="card shadow-sm rounded-4">
                    <div class="card-header bg-white fw-bold fs-5 rounded-top-4">
                        {{ $bonus->title }}
                    </div>

                    <div class="card-body p-0" style="height: 85vh;">
                        <iframe src="{{ $pdfUrl }}#toolbar=0&navpanes=0&scrollbar=0" width="100%" height="100%"
                            style="border:none;" oncontextmenu="return false">
                        </iframe>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Proteksi -->
    <script>
        // Disable klik kanan
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        // Disable Ctrl+S, Ctrl+P, Ctrl+U
        document.addEventListener('keydown', function(e) {
            if (
                (e.ctrlKey || e.metaKey) && ['s', 'p', 'u'].includes(e.key.toLowerCase())
            ) {
                e.preventDefault();
            }
        });
    </script>

</body>

</html>
