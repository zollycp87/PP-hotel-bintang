<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- favicon-->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- Site Title-->
    <title>HOTEL BINTANG FLORES</title>
    <meta name="description" content="A Template for Architectural Interior Design company website.">
    <!-- Bootstrap CSS file-->
    <link href="{{ asset('customer/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Flickity CSS file-->
    <link href="{{ asset('customer/assets/css/flickity.min.css') }}" rel="stylesheet">
    <!-- Main CSS file-->
    <link href="{{ asset('customer/assets/css/style.css') }}" rel="stylesheet">
    <!-- Fontawesome 5 CSS file-->
    <link href="{{ asset('customer/assets/css/fontawesome-all.min.css') }}" rel="stylesheet">
    <!-- Magnific Popup CSS-->
    <link href="{{ asset('customer/assets/css/magnific-popup.css') }}" rel="stylesheet">
    <!-- Google Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&amp;display=swap">

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
</head>

<body>
    <!-- Navbar-->
    @yield('navbar')
    <!-- End Navbar-->

    {{-- Content --}}
    @yield('content')
    {{-- END CONTENT --}}

    <!-- Footer-->
    <footer class="site-footer">
        <div class="footer-widgets">
            <div class="container">
                <div class="row gx-lg-5">
                    <div class="col-lg-6 pr-lg-10">
                        <div class="footer-widget footer-widget-1">
                            <h2 class="mb-4 text-ebony-clay">Hotel Bintang Flores</h2>
                            <p class="text-abbey pr-6">89, Jl. Flores No.3, Rejamulya, Gunungsimping, Kec. Cilacap
                                Tengah, Kabupaten Cilacap, Jawa Tengah 53223.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row gx-lg-5">
                            <div class="col-lg-4">
                                <div class="footer-widget footer-widget-4">
                                    <ul>
                                        <li><a href="page-contact-us.html">Contact Us</a></li>
                                        <li><a href="page-contact-us.html">hotelbintangflores@gmail.com</a></li>
                                        <li><a href="page-contact-us.html">02129707601</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="footer-widget footer-widget-3">
                                    <div class="text-abbey">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="footer-widget footer-widget-2">
                                    <ul>
                                        <li><a href="index.html">Home</a></li>
                                        <li><a href="blog.html">Blog</a></li>
                                        <li><a href="page-services.html">Service</a></li>
                                        <li><a href="page-about-us.html">About Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom-area">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="footer-widget">
                            <p class="m-md-0">© 2020 Energetic Themes</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="footer-widget">
                            <ul class="list-inline m-lg-0 p-lg-0 text-md-right footer-nav">
                                <li><a href="page-privacy-terms.html">Privacy Policy</a></li>
                                <li><a href="page-privacy-terms.html">Terms & Conditions</a></li>
                                <li class="list-inline-item py-lg-2 py-md-4 py-3 pl-lg-5 pl-md-10 pr-2"><a
                                        href="#"><i class="fab fa-linkedin-in icon"></i></a></li>
                                <li class="list-inline-item py-2 pr-2"><a href="#"><i
                                            class="fab fa-facebook-square icon"></i></a></li>
                                <li class="list-inline-item py-2 pr-2"><a href="#"><i
                                            class="fab fa-twitter icon"></i></a></li>
                                <li class="list-inline-item py-2 pr-2"><a href="#"><i
                                            class="fab fa-instagram icon"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer-->

    @yield('scripts')
    <!-- javascript files-->
    <!-- jquery-->
    <script src="{{ asset('customer/assets/js/jquery.min.js') }}"></script>
    <!-- lozad js-->
    <script src="{{ asset('customer/assets/js/lozad.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('customer/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Aos js-->
    <script src="{{ asset('customer/assets/js/aos.js') }}"></script>
    <!-- Slick flickity js-->
    <script src="{{ asset('customer/assets/js/flickity.pkgd.min.js') }}"></script>
    <!-- Magnific popup js-->
    <script src="{{ asset('customer/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Countdown js-->
    <script src="{{ asset('customer/assets/js/jquery.countdown.js') }}"></script>
    <!-- CountTo js-->
    <script src="{{ asset('customer/assets/js/jquery.countTo.js') }}"></script>
    <!-- Masonry js-->
    <script src="{{ asset('customer/assets/js/jquery.countTo.js') }}"></script>
    <!-- Global - Main js-->
    <script src="{{ asset('customer/assets/js/global.js') }}"></script>

</body>

</html>
