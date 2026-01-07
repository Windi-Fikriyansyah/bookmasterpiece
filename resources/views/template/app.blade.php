<!doctype html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>Book Masterpiece AI</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="Berry is trending dashboard template made using Bootstrap 5 design framework. Berry is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies." />
    <meta name="keywords"
        content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard" />
    <meta name="author" content="codedthemes" />

    @stack('style')
    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('layouts/assets/images/favicon.svg') }}" type="image/x-icon" />
    <!-- [Google Font] Family -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap"
        id="main-font-link" />
    <!-- [phosphor Icons] https://phosphoricons.com/ -->
    <link rel="stylesheet" href="{{ asset('layouts/assets/fonts/phosphor/duotone/style.css') }}" />
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('layouts/assets/fonts/tabler-icons.min.css') }}" />
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('layouts/assets/fonts/feather.css') }}" />
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('layouts/assets/fonts/fontawesome.css') }}" />
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('layouts/assets/fonts/material.css') }}" />
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('layouts/assets/css/style.css') }}" id="main-style-link" />
    <link rel="stylesheet" href="{{ asset('layouts/assets/css/style-preset.css') }}" />

    <style>
        .pc-sidebar .pc-link {
            gap: 10px;
            /* jarak icon ↔ text */
        }

        .pc-sidebar .pc-micon {
            width: 22px;
            /* default biasanya 40px+ */
            min-width: 22px;
            font-size: 18px;
            /* sesuaikan icon */
            text-align: center;
            margin-right: 4px;
        }

        /* Untuk submenu */
        .pc-sidebar .pc-submenu .pc-micon {
            width: 18px;
            min-width: 18px;
            font-size: 16px;
        }
    </style>
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] start -->
    <nav class="pc-sidebar">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="{{ route('dashboard') }}" class="b-brand d-flex align-items-center text-decoration-none">
                    <span class="fw-bold fs-3 text-primary">
                        Book<span class="text-dark"> Masterpiece AI</span>
                    </span>
                </a>

            </div>
            <div class="navbar-content">
                <ul class="pc-navbar">

                    <li class="pc-item">
                        <a href="{{ route('dashboard') }}" class="pc-link"><span class="pc-micon"><i
                                    class="ti ti-dashboard"></i></span><span class="pc-mtext">Dashboard</span></a>
                    </li>

                    <li class="pc-item">
                        <a href="{{ route('langganan') }}" class="pc-link"><span class="pc-micon"><i
                                    class="ti ti-credit-card"></i></span><span class="pc-mtext">Paket
                                BookMaster</span></a>
                    </li>
                    @auth

                        {{-- AKSES APLIKASI --}}
                        <li class="pc-item pc-hasmenu">
                            <a href="javascript:void(0)" class="pc-link">
                                <span class="pc-micon">
                                    <i class="ti ti-apps"></i>
                                </span>
                                <span class="pc-mtext">Akses Aplikasi</span>
                                <span class="pc-arrow"><i class="ti ti-chevron-right"></i></span>
                            </a>

                            <ul class="pc-submenu">
                                <li class="pc-item">
                                    <a href="{{ route('ebook_master') }}" class="pc-link">
                                        <span class="pc-micon">
                                            <i class="ti ti-book"></i>
                                        </span>
                                        <span class="pc-mtext">Book Masterpiece AI</span>
                                    </a>
                                </li>

                                @if (in_array($activeSubscription->duration, ['tahun', 'lifetime']))
                                    <li class="pc-item">
                                        <a href="{{ route('cover_master') }}" class="pc-link">
                                            <span class="pc-micon">
                                                <i class="ti ti-photo"></i>
                                            </span>
                                            <span class="pc-mtext">Book Cover Masterpiece (Bonus)</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>

                        {{-- LINK GRUP --}}
                        <li class="pc-item pc-hasmenu">
                            <a href="javascript:void(0)" class="pc-link">
                                <span class="pc-micon">
                                    <i class="ti ti-brand-whatsapp"></i>
                                </span>
                                <span class="pc-mtext">Link Grup</span>
                                <span class="pc-arrow"><i class="ti ti-chevron-right"></i></span>
                            </a>

                            <ul class="pc-submenu">

                                @if ($activeSubscription->duration === 'bulan')
                                    <li class="pc-item">
                                        <a href="{{ route('group.index') }}" class="pc-link">
                                            <span class="pc-micon">
                                                <i class="ti ti-users"></i>
                                            </span>
                                            <span class="pc-mtext">Grup Exclusive</span>
                                        </a>
                                    </li>
                                @endif
                                @if ($activeSubscription->duration === 'tahun')
                                    <li class="pc-item">
                                        <a href="{{ route('group.index') }}" class="pc-link">
                                            <span class="pc-micon">
                                                <i class="ti ti-users"></i>
                                            </span>
                                            <span class="pc-mtext">Grup Executive</span>
                                        </a>
                                    </li>
                                @endif

                                @if ($activeSubscription->duration === 'lifetime')
                                    <li class="pc-item">
                                        <a href="{{ route('group.index') }}" class="pc-link">
                                            <span class="pc-micon">
                                                <i class="ti ti-crown"></i>
                                            </span>
                                            <span class="pc-mtext">Grup Premium</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>

                        <li class="pc-item">
                            <a href="{{ route('bonus.index') }}" class="pc-link"><span class="pc-micon"><i
                                        class="ti ti-gift"></i></span><span class="pc-mtext">Bonus</span></a>
                        </li>


                        {{-- TUTORIAL --}}
                        <li class="pc-item pc-hasmenu">
                            <a href="javascript:void(0)" class="pc-link">
                                <span class="pc-micon">
                                    <i class="ti ti-video"></i>
                                </span>
                                <span class="pc-mtext">Tutorial</span>
                                <span class="pc-arrow"><i class="ti ti-chevron-right"></i></span>
                            </a>

                            <ul class="pc-submenu">
                                <li class="pc-item">
                                    <a href="{{ route('tutorial.index') }}" class="pc-link">
                                        <span class="pc-micon">
                                            <i class="ti ti-player-play"></i>
                                        </span>
                                        <span class="pc-mtext">Tutorial Penggunaan</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    @endauth









                </ul>

                <div class="w-100 text-center">
                    <div class="badge theme-version badge rounded-pill bg-light text-dark f-12"></div>
                </div>
            </div>
        </div>
    </nav>
    <!-- [ Sidebar Menu ] end -->
    <!-- [ Header Topbar ] start -->
    <header class="pc-header">
        <div class="header-wrapper"><!-- [Mobile Media Block] start -->
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <li class="pc-h-item header-mobile-collapse">
                        <a href="#" class="pc-head-link head-link-secondary ms-0" id="sidebar-hide">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="pc-h-item pc-sidebar-popup">
                        <a href="#" class="pc-head-link head-link-secondary ms-0" id="mobile-collapse">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>


                </ul>
            </div>
            <!-- [Mobile Media Block end] -->
            <div class="ms-auto">
                <ul class="list-unstyled">

                    {{-- JIKA SUDAH LOGIN --}}
                    @auth
                        <li class="dropdown pc-h-item header-user-profile">
                            <a class="pc-head-link head-link-primary dropdown-toggle arrow-none me-0"
                                data-bs-toggle="dropdown" href="#" role="button">
                                <img src="{{ asset('image/user.png') }}" alt="user-image" class="user-avtar" />
                                <span>
                                    <i class="ti ti-settings"></i>
                                </span>
                            </a>

                            <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                                <div class="dropdown-header">
                                    <h4>
                                        Hello,
                                        <span class="small text-muted">{{ auth()->user()->name }}</span>
                                    </h4>
                                    <hr />

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="ti ti-logout"></i>
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endauth

                    {{-- JIKA BELUM LOGIN --}}
                    @guest
                        <li class="pc-h-item">
                            <a href="{{ route('login') }}" class="btn btn-primary d-flex align-items-center gap-2 px-3">
                                <i class="ti ti-login"></i>
                                <span>Sign In</span>
                            </a>
                        </li>
                    @endguest

                </ul>
            </div>
        </div>
    </header>
    <!-- [ Header ] end -->



    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">

            @yield('content')

            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="col-sm-6 my-1">
                    <p class="m-0">
                        Book Masterpiece

                    </p>
                </div>
                <div class="col-sm-6 ms-auto my-1">
                    <ul class="list-inline footer-link mb-0 justify-content-sm-end d-flex">

                    </ul>
                </div>
            </div>
        </div>
    </footer>





    {{-- <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6 my-1">
                    <p class="m-0">
                        © {{ date('Y') }} <strong>Book Masterpiece AI</strong><br>
                        <small>AI-Powered Book Creation Platform</small>
                    </p>
                </div>

                <div class="col-sm-6 ms-auto my-1">
                    <ul class="list-inline footer-link mb-0 justify-content-sm-end d-flex gap-3">
                        <li class="list-inline-item">
                            <a href="{{ route('about') }}">Tentang Kami</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ route('privacy') }}">Kebijakan Privasi</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ route('terms') }}">Ketentuan Layanan</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ route('contact') }}">Kontak</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer> --}}



    <!-- Required Js -->
    <script src="{{ asset('layouts/assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('layouts/assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('layouts/assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('layouts/assets/js/icon/custom-font.js') }}"></script>
    <script src="{{ asset('layouts/assets/js/script.js') }}"></script>
    <script src="{{ asset('layouts/assets/js/theme.js') }}"></script>
    <script src="{{ asset('layouts/assets/js/plugins/feather.min.js') }}"></script>


    <script>
        layout_change('light');
    </script>

    <script>
        font_change('Roboto');
    </script>

    <script>
        change_box_container('false');
    </script>

    <script>
        layout_caption_change('true');
    </script>

    <script>
        layout_rtl_change('false');
    </script>

    <script>
        preset_change('preset-1');
    </script>



    <!-- [Page Specific JS] start -->
    <!-- Apex Chart -->
    <script src="{{ asset('layouts/assets/js/plugins/apexcharts.min.js') }}"></script>
    <script src="{{ asset('layouts/assets/js/pages/dashboard-default.js') }}"></script>
    <!-- [Page Specific JS] end -->
</body>
<!-- [Body] end -->

</html>
