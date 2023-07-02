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
                            <li class="nav-item"><a class="nav-link" href="{{ route('about-us') }}">About Us</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('kategori-list') }}">Room</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('contact-us') }}">Contact Us</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('cust.riwayat') }}">Riwayat</a></li>
                        </ul>
                        <ul class="nav-modules">
                            <!-- Login-->
                            <li class="nav-item dropdown" style="list-style: none"><a class="dropdown-toggle nav-link"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    href="#">Hai,
                                    {{ Auth::user()->nama }}</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('edit-profile-cust',Auth::user()->id_user) }}">Profile</a>
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
                            <li class="nav-item"><a class="nav-link" href="{{ route('about-us') }}">About Us</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('kategori-list') }}">Room</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('contact-us') }}">Contact Us</a></li>
                        </ul>
                        <ul class="nav-modules">
                            <!-- Login-->
                            <li class="nav-item" style="list-style: none"><a class="nav-link"
                                    href="{{ route('login') }}">Login</a>
                            </li>
                        </ul>
                        <ul class="nav-modules">
                            <!-- Login-->
                            <li class="nav-item" style="list-style: none"><a class="nav-link btn btn-primary"
                                    href="{{ route('register') }}">Register</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    @endif
