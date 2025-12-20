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

                    <li class="pc-item pc-caption">
                        <label>AKSES APLIKASI</label>
                        <i class="ti ti-apps"></i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('ebook_master') }}" class="pc-link"><span class="pc-micon"><i
                                    class="ti ti-book"></i></span><span class="pc-mtext">Link Akses Aplikasi "Book
                                Masterpiece AI"</span></a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('cover_master') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-photo"></i></span>
                            <span class="pc-mtext">Link Akses Aplikasi BONUS "Book Cover
                                Masterpiece"</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('langganan') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-photo"></i></span>
                            <span class="pc-mtext">Langganan</span>
                        </a>
                    </li>
                    {{-- <li class="pc-item">
                        <a href="{{ asset('layouts/elements/bc_color.html') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-trending-up"></i></span>
                            <span class="pc-mtext">Link Akses Bonus Ebook "Ebook Banjir
                                Pembeli Tanpa Ngiklan"</span>
                        </a>
                    </li> --}}

                    <li class="pc-item pc-caption">
                        <label>TUTORIAL</label>
                        <i class="ti ti-apps"></i>
                    </li>

                    <li class="pc-item">
                        <a href="{{ route('dashboard') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-video"></i></span>
                            <span class="pc-mtext">TUTORIAL PENGGUNAAN</span>
                        </a>
                    </li>



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

                    <li class="dropdown pc-h-item header-user-profile">
                        <a class="pc-head-link head-link-primary dropdown-toggle arrow-none me-0"
                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                            aria-expanded="false">
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
                                <div class="profile-notification-scroll position-relative"
                                    style="max-height: calc(100vh - 280px)">

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="ti ti-logout"></i>
                                            <span>Logout</span>
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </li>
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
