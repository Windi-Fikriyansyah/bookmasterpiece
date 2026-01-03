@extends('template.app')

@section('title', $bonus->title)

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="card shadow-sm rounded-4">
                <div class="card-header bg-white fw-bold">
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
@endsection

@section('scripts')
    <script>
        // Disable klik kanan global
        document.addEventListener('contextmenu', e => e.preventDefault());

        // Disable Ctrl+S & Ctrl+P
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && ['s', 'p'].includes(e.key.toLowerCase())) {
                e.preventDefault();
            }
        });
    </script>
@endsection
