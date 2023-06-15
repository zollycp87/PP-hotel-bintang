@extends('layouts.main-cust')

@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        hr {
            border: none;
            border-top: 1px solid rgba(0, 0, 0, 0.2);
            /* Warna abu-abu samar */
            margin: 10px 0;
            /* Jarak atas dan bawah */
        }
    </style>
    {{-- <div class="container-sm bg-primary d-flex justify-content-center mt-3 mb-3">
        <div class="col-8 bg-danger">
            <div class="card">
                <div class="card-body">
                    <div class="mr-3 ml-3 d-flex justify-content-between">
                        <h5 class="">Invoice</h5>
                        <h5>
                            <span class="badge badge-primary">New</span>
                        </h5>
                    </div>
                    <hr>
                    .
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container py-3 mb-5 h-100">
        <div class="row d-flex align-items-center h-100">
            <div class="col-md-10 col-lg-8 col-xl-6">
                <div class="card card-stepper" style="border-radius: 16px;">
                    <div class="card-header p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-2"> Order ID <span class="fw-bold text-body">1222528743</span>
                                </p>
                                <p class="text-muted mb-0"> Place On <span class="fw-bold text-body">12,March
                                        2019</span> </p>
                            </div>
                            <div>
                                <h4 class="mb-0"> <span class="badge badge-primary">New</span> </h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-flex flex-row mb-0 pb-2">
                            <div class="flex-fill">
                                <h5 class="bold">Headphones Bose 35 II</h5>
                                <p class="text-muted"> Qt: 1 item</p>
                                <h4 class="mb-1"> $ 299 <span class="small text-muted"> via (COD) </span></h4>
                            </div>
                            <div>
                                {{-- <img class="align-self-center img-fluid"
                                        src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/6.webp"
                                        width="250"> --}}
                                <p class="text-muted text-right">Tracking Status on:
                                    <br>
                                    <span class="text-body">11:30pm, Today</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-3">
                        <div class="d-flex justify-content-end">
                            <h6 class="fw-normal mb-0 mr-3"><a href="#!">Cancel</a></h6>
                            <h6 class="fw-normal mb-0"><a href="#!">Pre-pay</a></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- NAVBAR --}}
@section('navbar')
    @include('navbar-cust')
@endsection
{{-- NAVBAR END --}}
