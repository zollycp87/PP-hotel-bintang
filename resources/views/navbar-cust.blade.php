    {{-- Jika Login --}}
    @if (Auth::check())
        <div class="site-header">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container"><a class="navbar-brand" href="index.html">
                        <h4>Hotel Bintang Flores</h4>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><span
                            class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item"><a class="nav-link" href="{{ route('cust.landing-page') }}">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="index.html">About Us</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('kategori-list') }}">Room</a></li>
                            <li class="nav-item"><a class="nav-link" href="index.html">Contact Us</a></li>
                            {{-- <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" href="#"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
                                <div class="dropdown-menu"><a class="dropdown-item" href="page-about-us.html">About
                                        Us</a><a class="dropdown-item" href="page-contact.html">Contact Us</a></div>
                            </li> --}}
                            <!-- <li class="nav-item dropdown mega_menu_holder"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Blog</a>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="blog.html">Blog</a><a class="dropdown-item" href="blog-right-sidebar.html">Right Sidebar</a><a class="dropdown-item" href="blog-left-sidebar.html">Left Sidebar</a><a class="dropdown-item" href="blog-three-col.html">Three Col</a><a class="dropdown-item" href="blog-two-col-right-sidebar.html">Two Col Right Sidebar</a><a class="dropdown-item" href="blog-two-col-left-sidebar.html">Two Col Left Sidebar</a><a class="dropdown-item" href="blog-card-right-sidebar.html">Card Right Sidebar</a><a class="dropdown-item" href="blog-card-left-sidebar.html">Card Left Sidebar</a><a class="dropdown-item" href="blog-card-three-col.html">Card Three Col</a><a class="dropdown-item" href="blog-card-two-col-right-sidebar.html">Card two Col Right Sidebar</a><a class="dropdown-item" href="blog-card-two-col-left-sidebar.html">Card two Col Left Sidebar</a><a class="dropdown-item" href="blog-single-post.html">Single Post</a><a class="dropdown-item" href="blog-single-post-gallery.html">Single Gallary Post </a><a class="dropdown-item" href="blog-single-post-video.html">Single Video Post</a><a class="dropdown-item" href="blog-single-post-audio.html">Single Audio Post</a></div>
                                                        </li> -->
                            {{-- <li class="nav-item dropdown mega_menu_holder"><a class="dropdown-toggle nav-link"
                                    href="#" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">Booking</a>
                                <div class="dropdown-menu"><a class="dropdown-item"
                                        href="page-property-list.html">Booking
                                        Kamar</a><a class="dropdown-item" href="property-single.html">Detail Kamar</a>
                                </div>
                            </li> --}}
                            <!-- <li class="nav-item"><a class="nav-link" href="element-accordions.html">Element</a></li> -->
                            <li class="nav-item"><a class="nav-link" href="{{ route('cust.riwayat') }}">Riwayat</a></li>
                        </ul>
                        <ul class="nav-modules">
                            <!-- Login-->
                            <li class="nav-item dropdown" style="list-style: none"><a class="dropdown-toggle nav-link"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    href="#">Hai,
                                    {{ Auth::user()->nama }}</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('cust-profile') }}">Profile</a>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right"></i>
                                            <span>Keluar</span>
                                        </button>
                                    </form>
                                </div>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        {{-- Jika Login END --}}
    @else
        <div class="site-header">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container"><a class="navbar-brand" href="index.html">
                        <h3 class="ml-3">Hotel Bintang Flores</h3>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                        aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item"><a class="nav-link" href="{{ route('landing-page') }}">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="index.html">About Us</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('kategori-list') }}">Room</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="index.html">Contact Us</a></li>
                            {{-- <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" href="#"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
                                <div class="dropdown-menu"><a class="dropdown-item" href="page-about-us.html">About
                                        Us</a><a class="dropdown-item" href="page-contact.html">Contact Us</a></div>
                            </li> --}}
                            <!-- <li class="nav-item dropdown mega_menu_holder"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Blog</a>
                                                            <div class="dropdown-menu"><a class="dropdown-item" href="blog.html">Blog</a><a class="dropdown-item" href="blog-right-sidebar.html">Right Sidebar</a><a class="dropdown-item" href="blog-left-sidebar.html">Left Sidebar</a><a class="dropdown-item" href="blog-three-col.html">Three Col</a><a class="dropdown-item" href="blog-two-col-right-sidebar.html">Two Col Right Sidebar</a><a class="dropdown-item" href="blog-two-col-left-sidebar.html">Two Col Left Sidebar</a><a class="dropdown-item" href="blog-card-right-sidebar.html">Card Right Sidebar</a><a class="dropdown-item" href="blog-card-left-sidebar.html">Card Left Sidebar</a><a class="dropdown-item" href="blog-card-three-col.html">Card Three Col</a><a class="dropdown-item" href="blog-card-two-col-right-sidebar.html">Card two Col Right Sidebar</a><a class="dropdown-item" href="blog-card-two-col-left-sidebar.html">Card two Col Left Sidebar</a><a class="dropdown-item" href="blog-single-post.html">Single Post</a><a class="dropdown-item" href="blog-single-post-gallery.html">Single Gallary Post </a><a class="dropdown-item" href="blog-single-post-video.html">Single Video Post</a><a class="dropdown-item" href="blog-single-post-audio.html">Single Audio Post</a></div>
                                                        </li> -->
                            {{-- <li class="nav-item dropdown mega_menu_holder"><a class="dropdown-toggle nav-link"
                                    href="#" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">Booking</a>
                                <div class="dropdown-menu"><a class="dropdown-item"
                                        href="page-property-list.html">Booking
                                        Kamar</a><a class="dropdown-item" href="property-single.html">Detail Kamar</a>
                                </div>
                            </li> --}}
                            <!-- <li class="nav-item"><a class="nav-link" href="element-accordions.html">Element</a></li> -->
                            {{-- <li class="nav-item"><a class="nav-link" href="page-riwayat.html">Riwayat</a></li> --}}
                        </ul>
                        <ul class="nav-modules">
                            <!-- Login-->
                            <li class="nav-item" style="list-style: none"><a class="nav-link"
                                    href="login">Login</a>
                            </li>
                        </ul>
                        <ul class="nav-modules">
                            <!-- Login-->
                            <li class="nav-item" style="list-style: none"><a class="nav-link btn btn-primary"
                                    href="register">Register</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    @endif
