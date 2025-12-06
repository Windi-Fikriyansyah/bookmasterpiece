@extends('template.app')
@section('title', 'Dashboard')

@section('content')

    <div class="max-w-4xl mx-auto bg-white p-6 md:p-8 rounded-xl shadow-lg">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Syarat & Ketentuan</h1>
                <p class="text-gray-500 text-sm">Last updated: <span class="font-medium">28 Oct 2025, 11.39</span></p>
            </div>


        </div>

        <!-- Peringatan -->
        <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-lg flex gap-3 mb-6">
            <span class="text-xl">🔴</span>
            <p class="text-sm leading-relaxed">
                Mohon dibaca dulu agar bisa paham syarat dan ketentuan, dan tidak terjadi kesalahan di kemudian hari 🙏
            </p>
        </div>

        <!-- Konten -->
        <div class="space-y-5 text-gray-700 leading-relaxed text-[15px]">

            <p><strong>Syarat ketentuan pembelian EBOOK MASTER MAKER :</strong></p>

            <ol class="list-decimal list-inside space-y-3">
                <li>Anda berhak menggunakan semua fitur yang ada di EBOOK MASTER MAKER.</li>

                <li>Hasil ebook maupun cover ebook adalah sepenuhnya milik anda, dan anda berhak menggunakan ebook secara
                    pribadi, menjual ebook, atau membagikan ebook yang dibuat dari aplikasi ini.</li>

                <li>Anda tidak diperkenankan membagikan secara gratis link aplikasi EBOOK MASTER MAKER dalam segala jenis
                    bentuk pendistribusian.</li>

                <li>Anda tidak diperkenankan menjual aplikasi atau link EBOOK MASTER MAKER dalam segala jenis bentuk
                    penjualan.</li>

                <li>Anda tidak diperkenankan mengubah aplikasi EBOOK MASTER MAKER dalam bentuk apapun, teknologi yang ada di
                    aplikasi EBOOK MASTER MAKER bisa melakukan tracking jika ada penyalahgunaan bentuk dan fungsi dan cara
                    distribusi.</li>

                <li>Fitur di dalam aplikasi EBOOK MASTER MAKER akan terus berkembang karena berbasis AI, segala sesuatu bisa
                    berubah di dalamnya tanpa ada pemberitahuan.</li>

                <li>Anda bersedia melakukan pengecekan secara bertahap di menu akses aplikasi ini, dikarenakan ketika ada
                    update, link akses aplikasi bisa berubah.</li>

                <li>Jika terjadi penyalahgunaan hak dan wewenang dari poin no 1-7 di atas, maka kami akan memproses sesuai
                    hukum yang berlaku di Indonesia.</li>

                <li>
                    Aplikasi ini telah didaftarkan hak cipta nya, dan dilindungi sesuai dengan UNDANG-UNDANG HAK CIPTA Pasal
                    113 ayat (3) yang isinya:
                    <br><br>
                    <span class="italic block bg-gray-100 p-3 rounded-md border border-gray-300">
                        “Setiap orang yang dengan sengaja dan tanpa hak melakukan pelanggaran hak ekonomi Pencipta dipidana
                        dengan pidana penjara paling lama 4 (empat) tahun dan/atau denda paling banyak Rp1.000.000.000,00.”
                    </span>
                </li>
            </ol>

            <p class="mt-6 font-medium">
                Dengan mengklik lanjutkan, maka secara otomatis anda dianggap sudah membaca dan menyetujui syarat ketentuan
                ini.
            </p>

            {{-- <div class="text-right mt-6">
                <button class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow-md font-semibold">
                    Lanjutkan
                </button>
            </div> --}}

        </div>

    </div>

@endsection
