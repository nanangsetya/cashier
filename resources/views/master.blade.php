<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <!-- Foodwagon | Responsive, Ecommerce &amp; Business Templatee</title> -->
    <title>Cashier</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/assets/img/gallery/logo.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/assets/img/gallery/logo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/assets/img/gallery/logo.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/assets/img/gallery/logo.png') }}">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="{{ asset('assets/assets/img/gallery/logo.png') }}">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="{{ asset('assets/assets/css/theme.css') }}" rel="stylesheet" />
    <style>
        .form-control {
            background-color: white
        }

    </style>
    @stack('styles')
    @livewireStyles
</head>


<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" data-navbar-on-scroll="data-navbar-on-scroll">
            <div class="container"><a class="navbar-brand d-inline-flex" href="/"><img class="d-inline-block" src="{{ asset('assets/assets/img/gallery/logo.png') }}" alt="logo" style="max-height: 40px" /><span class="text-1000 fs-3 fw-bold ms-2 text-gradient">Cashier</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
                <div class="collapse navbar-collapse border-top border-lg-0 my-2 mt-lg-0" id="navbarSupportedContent">
                    <div class="mx-auto pt-5 pt-lg-0 d-block d-lg-none d-xl-block">
                    </div>
                    @if(auth()->check())
                        <a class="nav-link btn btn-white shadow-warning text-warning" aria-current="page" href="{{ route('cart') }}"><i class="fas fa-cash-register"></i> Cashier</a>
                        <a class="nav-link btn btn-white shadow-warning text-warning" aria-current="page" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        <a class="nav-link btn btn-white shadow-warning text-warning" aria-current="page" href="{{ route('product') }}"><i class="fas fa-shopping-basket"></i> Product</a>
                        <li class="nav-link nav-item dropdown">
                            <a class="nav-link btn btn-white shadow-warning text-warning dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i>{{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="border-width: 0;">
                                <li><a class="dropdown-item shadow-warning text-warning" href="{{ route('logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </div>
            </div>
        </nav>

        @yield('content')

        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="py-0 pt-7 bg-1000">

            <div class="container">
                <hr class="border border-800" />
                <div class="row flex-center pb-3">
                    <div class="col-md-6 order-0">
                        <p class="text-200 text-center text-md-start">All rights Reserved &copy; Your Company, 2021</p>
                    </div>
                    <div class="col-md-6 order-1">
                        <p class="text-200 text-center text-md-end"> Made with&nbsp;
                            <svg class="bi bi-suit-heart-fill" xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="#FFB30E" viewBox="0 0 16 16">
                                <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"></path>
                            </svg>&nbsp;by&nbsp;<a class="text-200 fw-bold" href="https://themewagon.com/" target="_blank">ThemeWagon </a>
                        </p>
                    </div>
                </div>
            </div><!-- end of .container-->

        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->


    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/vendors/@popperjs/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/is/is.min.js') }}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ asset('assets/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('assets/assets/js/theme.js') }}"></script>

    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400;600;700;900&amp;display=swap" rel="stylesheet">

    @stack('scripts')
    @livewireScripts
</body>

</html>
