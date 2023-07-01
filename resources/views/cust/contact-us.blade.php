@extends('layouts.main-cust')

@section('content')
    <article class="entry">
        <div class="entry-content">
            <div class="container mb-lg-4 mb-md-7 mb-5 ml-lg-4">
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="map-responsive">
                                <iframe id="gmap_canvas" width="100%" height="450"
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.8291406415606!2d109.02011207414729!3d-7.701477292316049!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6512c9babb0553%3A0xca8fa05058c78e11!2sHotel%20Bintang%20Flores!5e0!3m2!1sid!2sid!4v1685967777878!5m2!1sid!2sid"
                                    style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="ml-1">
                                <h4 class="mb-3">Hubungi Kami</h4>
                                <div class="border-bottom border-athens-gray">
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <h5 class="text-silver-chalice">Alamat</h5>
                                        </div>
                                        <div class="col-lg-8">
                                            <p class="lead">Jalan Flores No.3, Rejamulya, Gunungsimping,
                                                Kec. Cilacap Tengah, Kabupaten Cilacap, Jawa Tengah 53223.</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <h5 class="text-silver-chalice">Email</h5>
                                        </div>
                                        <div class="col-lg-8">
                                            <p class="lead">hotelbintangflores@gmail.com</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <h5 class="text-silver-chalice">Phone</h5>
                                        </div>
                                        <div class="col-lg-8">
                                            <p class="lead">02129707601</p>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-lg-3">
                                            <h5 class="text-silver-chalice">Social</h5>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="ml-2">
                                                <ul class="list-unstyled list-inline true">
                                                    <li class="list-inline-item"><a class="pr-2 text-ebony-clay"
                                                            href="#"><i class="fab fa-linkedin-in"></i></a>
                                                    </li>
                                                    <li class="list-inline-item"><a class="pr-2 text-ebony-clay"
                                                            href="#"><i class="fab fa-twitter"></i></a>
                                                    </li>
                                                    <li class="list-inline-item"><a class="pr-2 text-ebony-clay"
                                                            href="#"><i class="fab fa-instagram"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

{{-- NAVBAR --}}
@section('navbar')
    @include('navbar-cust')
@endsection
{{-- NAVBAR END --}}
