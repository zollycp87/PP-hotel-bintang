<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin-dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        @if (Auth::user()->role == 'Super Admin')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#user-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person-lines-fill"></i><span>Kelola Data User</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="user-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('kelola-user.index') }}">
                            <i class="bi bi-circle"></i><span>Data User</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('kelola-customer.index') }}">
                            <i class="bi bi-circle"></i><span>Data Tamu</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Kelola User -->
        @endif

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#hotel-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-door-closed-fill"></i><span>Kelola Data Hotel</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="hotel-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('kelola-kategori.index') }}">
                        <i class="bi bi-circle"></i><span>Data Kategori Kamar</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('kelola-kamar.index') }}">
                        <i class="bi bi-circle"></i><span>Data Kamar</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Kelola Hotel -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#booking-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-calendar-check-fill"></i><span>Kelola Data Booking</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="booking-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('booking.index') }}">
                        <i class="bi bi-circle"></i><span>Data Booking</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Kelola Booking -->

    </ul>

</aside><!-- End Sidebar-->
