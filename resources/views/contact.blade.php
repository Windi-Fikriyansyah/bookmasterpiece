@extends('template.app')

@section('title', 'Kontak Kami')

@section('content')
    <div class="container py-5" style="max-width: 900px">

        {{-- JUDUL --}}
        <div class="text-center mb-5">
            <h1 class="fw-bold">Kontak Kami</h1>
            <p class="text-muted">
                Hubungi tim <strong>Book Masterpiece AI</strong> jika Anda memiliki pertanyaan,
                kendala teknis, atau membutuhkan bantuan terkait layanan kami.
            </p>
        </div>

        <div class="row g-4">
            {{-- INFORMASI KONTAK --}}
            <div class="col-md-5">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Informasi Kontak</h5>

                        <p class="mb-2">
                            <i class="ti ti-world me-2 text-primary"></i>
                            <strong>Website</strong><br>
                            <span class="text-muted">http://bookmasterpiece.sekolahliterasi.com</span>
                        </p>

                        <p class="mb-2">
                            <i class="ti ti-mail me-2 text-primary"></i>
                            <strong>Email Support</strong><br>
                            <span class="text-muted">bookmasterpiece@gmail.com</span>
                        </p>

                        <p class="mb-2">
                            <i class="ti ti-brand-whatsapp me-2 text-primary"></i>
                            <strong>WhatsApp</strong><br>
                            <span class="text-muted">+62 899-1111-901</span>
                        </p>

                        <p class="mb-0">
                            <i class="ti ti-clock me-2 text-primary"></i>
                            <strong>Jam Operasional</strong><br>
                            <span class="text-muted">
                                Senin – Jumat<br>
                                09.00 – 17.00 WIB
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            {{-- FORM KONTAK (NON AKTIF / INFORMASI SAJA) --}}
            <div class="col-md-7">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Kirim Pesan</h5>

                        <div class="alert alert-info">
                            Form ini disediakan sebagai sarana komunikasi.
                            Untuk respon tercepat, silakan hubungi kami melalui email atau WhatsApp.
                        </div>

                        <form>
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" placeholder="Nama Anda" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="email@contoh.com" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Pesan</label>
                                <textarea class="form-control" rows="4" placeholder="Tulis pesan Anda..." disabled></textarea>
                            </div>

                            <button type="button" class="btn btn-primary w-100" disabled>
                                Kirim Pesan
                            </button>
                        </form>

                        <small class="text-muted d-block mt-3">
                            * Form ini dapat diaktifkan kapan saja sesuai kebutuhan sistem.
                        </small>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
