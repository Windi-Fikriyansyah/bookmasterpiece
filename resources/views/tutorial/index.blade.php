@extends('template.app')

@section('title', 'Tutorial Penggunaan')

@section('content')
    <div class="row pb-4">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-1">
                        🎥 Tutorial Penggunaan Book Masterpiece AI
                    </h4>
                    <p class="text-muted mb-0">
                        Pelajari cara menggunakan fitur Book Masterpiece AI secara lengkap dan mudah.
                    </p>
                </div>
            </div>
        </div>

        {{-- LIST VIDEO --}}
        <div class="col-12">
            <div class="row g-4">

                {{-- VIDEO 1 --}}
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="ratio ratio-16x9 rounded-top overflow-hidden">
                            <iframe src="https://www.youtube.com/embed/sIGpJAFs3b8?si=S83EA3ibTjpzbfAx"
                                title="Tutorial Memulai" allowfullscreen>
                            </iframe>
                        </div>
                        <div class="card-body">
                            <h6 class="fw-semibold mb-1">Memulai Book Masterpiece AI</h6>
                            <p class="text-muted small mb-0">
                                Panduan Gogle AI API Key.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- VIDEO 2 --}}
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="ratio ratio-16x9 rounded-top overflow-hidden">
                            <iframe src="https://www.youtube.com/embed/n42gSRtERmg?si=t_sjjDc9duEkpeIm"
                                title="Membuat Outline Buku" allowfullscreen>
                            </iframe>
                        </div>
                        <div class="card-body">
                            <h6 class="fw-semibold mb-1">Membuat Outline & Daftar Isi</h6>
                            <p class="text-muted small mb-0">
                                Panduan Formula Pensera
                            </p>
                        </div>
                    </div>
                </div>

                {{-- VIDEO 3 --}}
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="ratio ratio-16x9 rounded-top overflow-hidden">
                            <iframe src="https://www.youtube.com/embed/2zsFcymkfWc?si=yyizYD8rwMimznDf" title="Export Buku"
                                allowfullscreen>
                            </iframe>
                        </div>
                        <div class="card-body">
                            <h6 class="fw-semibold mb-1">Export & Finalisasi Buku</h6>
                            <p class="text-muted small mb-0">
                                Membuat Judul buku
                            </p>
                        </div>
                    </div>
                </div>


                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="ratio ratio-16x9 rounded-top overflow-hidden">
                            <iframe src="https://www.youtube.com/embed/r5kAavVFAZQ?si=-kuCW2I1IcaqjIJW" title="Export Buku"
                                allowfullscreen>
                            </iframe>
                        </div>
                        <div class="card-body">
                            <h6 class="fw-semibold mb-1">Export & Finalisasi Buku</h6>
                            <p class="text-muted small mb-0">
                                Membuat Daftar Isi
                            </p>
                        </div>
                    </div>
                </div>


                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="ratio ratio-16x9 rounded-top overflow-hidden">
                            <iframe src="https://www.youtube.com/embed/4nnNLuFxuAI?si=JN1geibCncqqx9z3" title="Export Buku"
                                allowfullscreen>
                            </iframe>
                        </div>
                        <div class="card-body">
                            <h6 class="fw-semibold mb-1">Export & Finalisasi Buku</h6>
                            <p class="text-muted small mb-0">
                                Membuat Kata Pengantar
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="ratio ratio-16x9 rounded-top overflow-hidden">
                            <iframe src="https://www.youtube.com/embed/rfOhVDeErps?si=zfMXHVez_mXXfAg6" title="Export Buku"
                                allowfullscreen>
                            </iframe>
                        </div>
                        <div class="card-body">
                            <h6 class="fw-semibold mb-1">Export & Finalisasi Buku</h6>
                            <p class="text-muted small mb-0">
                                Membuat Pendahuluan
                            </p>
                        </div>
                    </div>
                </div>


                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="ratio ratio-16x9 rounded-top overflow-hidden">
                            <iframe src="https://www.youtube.com/embed/8yqvllWoPK4?si=ibsELkcTc3xEkNjc" title="Export Buku"
                                allowfullscreen>
                            </iframe>
                        </div>
                        <div class="card-body">
                            <h6 class="fw-semibold mb-1">Export & Finalisasi Buku</h6>
                            <p class="text-muted small mb-0">
                                Membuat Bab & Sub Bab
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="ratio ratio-16x9 rounded-top overflow-hidden">
                            <iframe src="https://www.youtube.com/embed/XP4tbEQK8k0?si=0FgJQTN6WPLNuBUe" title="Export Buku"
                                allowfullscreen>
                            </iframe>
                        </div>
                        <div class="card-body">
                            <h6 class="fw-semibold mb-1">Export & Finalisasi Buku</h6>
                            <p class="text-muted small mb-0">
                                Membuat Penutup Buku
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="ratio ratio-16x9 rounded-top overflow-hidden">
                            <iframe src="https://www.youtube.com/embed/5uSyVATbXNk?si=Y8r6NLsIfhI5lv4q" title="Export Buku"
                                allowfullscreen>
                            </iframe>
                        </div>
                        <div class="card-body">
                            <h6 class="fw-semibold mb-1">Export & Finalisasi Buku</h6>
                            <p class="text-muted small mb-0">
                                Membuat Daftar Pustaka
                            </p>
                        </div>
                    </div>
                </div>


                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="ratio ratio-16x9 rounded-top overflow-hidden">
                            <iframe src="https://www.youtube.com/embed/XbXSTAF63j4?si=DpBiwmDQ3o2UrmFa" title="Export Buku"
                                allowfullscreen>
                            </iframe>
                        </div>
                        <div class="card-body">
                            <h6 class="fw-semibold mb-1">Export & Finalisasi Buku</h6>
                            <p class="text-muted small mb-0">
                                Membuat Profil Penulis
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
