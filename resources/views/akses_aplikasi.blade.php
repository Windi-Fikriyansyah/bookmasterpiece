@extends('template.app')

@section('title', 'Akses Aplikasi - Ebook Master Maker')

@push('styles')
    <style>
        .tab-active {
            @apply bg-blue-600 text-white;
        }
    </style>
@endpush

@section('content')

    <div class="max-w-6xl mx-auto">

        <!-- Judul Halaman -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">{{ $pageTitle ?? 'Akses Aplikasi' }}</h1>
            <p class="text-gray-600 mt-1">Semua link akses aplikasi utama & bonus Anda</p>
        </div>




        <!-- TAB CONTENT 1 -->
        <div id="tab1" class="tab-content">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">

                <!-- Judul -->
                <h2 class="text-xl font-bold text-gray-800 mb-1">1. Link Akses Aplikasi "Ebook Master Maker"</h2>

                <!-- Last Updated -->
                <p class="text-sm text-gray-500 mb-4">
                    Last updated: <span class="font-semibold text-gray-700">19 Nov 2025, 15.19</span>
                </p>

                <!-- Tombol Akses -->
                <a href="{{ route('bookmasterpiece.index') }}"
                    class="inline-flex items-center gap-2 bg-blue-600 text-white px-5 py-3 rounded-lg hover:bg-blue-700 transition">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    Klik disini untuk akses aplikasi EBOOK MASTER MAKER Versi Terbaru (3.0)
                </a>

                <!-- Pemberitahuan Penting -->
                <div class="mt-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                    <p class="text-red-700 text-sm leading-relaxed">
                        Jika tulisan yang ada di kotak merah pada gambar di atas tidak ada pada aplikasi anda,
                        artinya anda masih menggunakan versi lama.
                        <br><br>
                        <strong>Segera klik lagi link di atas atau refresh page anda</strong> sampai tulisan yang
                        dikotak merah tampil di aplikasi anda.
                    </p>
                </div>

                <!-- Info Versi -->
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Versi Terbaru (3.0) – Update 19 November 2025</h3>

                    <ul class="space-y-2 text-gray-700 text-sm">
                        <li>✔ Bisa sisipkan bab baru antar bab yang sudah ada</li>
                        <li>✔ Bisa regenerate berkali-kali oleh AI untuk semua bagian ebook</li>
                        <li>✔ Bisa menambah judul bab secara manual</li>
                        <li>✔ Sudah menggunakan update terbaru dari AI Google</li>
                    </ul>
                </div>

                <!-- Peringatan -->
                <div class="mt-6 bg-yellow-50 border-l-4 border-yellow-600 p-4 rounded">
                    <p class="text-yellow-800 text-sm leading-relaxed">
                        <strong>Tidak disarankan menggunakan versi sebelumnya</strong> karena akan mengakibatkan error
                        pada saat pembuatan konten ebook.
                        <br><br>
                        Wajib gunakan versi <strong>3.0 (update 19 November 2025)</strong>.
                    </p>
                </div>

                <!-- Catatan -->
                <div class="mt-6 border-t pt-4">
                    <p class="text-gray-700 text-sm">
                        <strong>Catatan:</strong> Agar tidak bingung saat menggunakan versi terbaru,
                        <strong>wajib nonton tutorial versi terbaru</strong>.
                        <br>
                        Videonya ada di modul <strong>"Tutorial Penggunaan"</strong> — video no <strong>10</strong>.
                    </p>
                </div>

            </div>
        </div>


        <div id="tab2" class="tab-content hidden">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">

                <!-- Judul -->
                <h2 class="text-xl font-bold text-gray-800 mb-1">
                    2. Link Akses Aplikasi BONUS "Ebook Cover Maker"
                </h2>

                <!-- Last Updated -->
                <p class="text-sm text-gray-500 mb-4">
                    Last updated: <span class="font-semibold text-gray-700">31 Oct 2025, 1.15</span>
                </p>

                <!-- Tombol Akses -->
                <a href="https://gemini.google.com/share/ce0239c238a1" target="_blank"
                    class="inline-flex items-center gap-2 bg-purple-600 text-white px-5 py-3 rounded-lg hover:bg-purple-700 transition">
                    <i class="fa-solid fa-palette"></i>
                    Klik disini untuk mengakses aplikasi Ebook Cover Maker...
                </a>

                <!-- Catatan -->
                <div class="mt-6 bg-yellow-50 border-l-4 border-yellow-600 p-4 rounded">
                    <p class="text-yellow-800 text-sm leading-relaxed">
                        <strong>Catatan:</strong> ini adalah aplikasi khusus untuk membuat cover/sampul ebook.
                        <br>
                        Harga aslinya adalah <strong>Rp 149.000</strong>, namun aplikasi ini diberikan sebagai
                        <strong>bonus spesial</strong> untuk Anda 😉
                    </p>
                </div>

            </div>
        </div>


        <!-- TAB CONTENT 3 -->
        <div id="tab3" class="hidden tab-content">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <h2 class="text-xl font-bold text-gray-800 mb-3">Bonus Ebook – Banjir Pembeli Tanpa Iklan</h2>
                <p class="text-gray-600 mb-4">
                    Ebook premium yang mengajarkan strategi menjual ebook tanpa keluar biaya iklan.
                </p>

                <a href="#"
                    class="inline-flex items-center gap-2 bg-amber-600 text-white px-5 py-3 rounded-lg hover:bg-amber-700 transition">
                    <i class="fa-solid fa-book-open"></i>
                    Download Ebook Bonus
                </a>

                <div class="mt-6 border-t pt-4">
                    <h3 class="font-semibold mb-2 text-gray-800">Isi ebook:</h3>
                    <ul class="text-gray-700 space-y-2 text-sm">
                        <li>✔ Sistem Jualan Tanpa Ads</li>
                        <li>✔ Teknik Organik Viral</li>
                        <li>✔ Cara Bangun Audience Cepat</li>
                        <li>✔ Contoh Copywriting Menjual</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script>
        function openTab(tabId) {

            // sembunyikan semua tab
            document.querySelectorAll(".tab-content").forEach(el => el.classList.add("hidden"));

            // tampilkan tab yang dipilih
            document.getElementById(tabId).classList.remove("hidden");

            // ==========================
            // ACTIVE SIDEBAR
            // ==========================
            document.querySelectorAll(".sidebar-link").forEach(link => {
                link.classList.remove("sidebar-active");
            });

            const activeSidebar = document.getElementById("sidebar-" + tabId);
            if (activeSidebar) {
                activeSidebar.classList.add("sidebar-active");
            }
        }

        // otomatis buka tab sesuai URL
        document.addEventListener("DOMContentLoaded", function() {
            const params = new URLSearchParams(window.location.search);
            const tab = params.get("tab") ?? "1";

            openTab("tab" + tab);
        });

        // agar saat sidebar diklik → aktif langsung berubah
        document.querySelectorAll(".sidebar-link").forEach(link => {
            link.addEventListener("click", function() {
                document.querySelectorAll(".sidebar-link").forEach(l => l.classList.remove(
                    "sidebar-active"));
                this.classList.add("sidebar-active");
            });
        });
    </script>
@endpush
