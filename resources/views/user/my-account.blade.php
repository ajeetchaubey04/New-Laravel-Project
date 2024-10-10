@extends('layouts.app')

@section('meta')
    {{-- <title>{{ $product->meta ? $product->meta->title : '' }}</title>
    <meta content="{{ $product->meta ? $product->meta->description : '' }}" name="description">
    <meta content="{{ $product->meta ? $product->meta->keywords : '' }}" name="keywords"> --}}
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('website/css/user.css') }}?v={{ time() }}">
@endpush

@section('content')
    <!-- User Details -->
    <section class="product-detail-section user-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrums">
                        <a href="/">Home</a> <span>></span> My Account
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- User Details End -->

    <!-- User Details -->

    <div class="d-flex justify-content-center align-items-center user-details">
        <div class="container p-3">
            <div class="row">
                

                <div class="col-md-6 mt-2">
                    <a href="{{ route('user.my-account') }}">
                        <div class="card bg-white rounded-4 p-2 mb-lg-0 mb-3">
                            <div class="hstack gap-3">
                                <div class="p-2  rounded-circle badge badge-icon">
                                    <i class="fa-solid fa-earth-asia color-white fs-5"></i>
                                </div>
                                <div class="p-2 ms-auto ">
                                    <h4 class="fs-6 text-black-50 lh-1 fw-bold">My Orders</h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 mt-2">
                    <a href="{{ route("user.my-address-book") }}">
                        <div class="card bg-white rounded-4 p-2 mb-lg-0 mb-3"
                            data-tor="inview:bg(primary) , hover:bg(danger)">
                            <div class="hstack gap-3">
                                <div class="p-2 rounded-circle badge badge-icon">
                                    <i class="fa fa-address-card color-white fs-5 d-inline-block w-16"></i>
                                </div>
                                <div class="p-2 ms-auto">
                                    <h4 class="fs-6 text-black-50 lh-1 fw-bold">My Address Book</h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-md-6 mt-2">
                    <a href="{{ route('user.my-account') }}">
                        <div class="card bg-white rounded-4 p-2 mb-lg-0 mb-3">
                            <div class="hstack gap-3">
                                <div class="p-2 rounded-circle badge badge-icon">
                                    <i class="fa-solid fa-file-invoice color-white fs-5"></i>
                                </div>
                                <div class="p-2 ms-auto ">
                                    <h4 class="fs-6 text-black-50 lh-1 fw-bold">Account Deatils</h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                {{-- <div class="col-md-6  mt-2">
                    <div class="card bg-white rounded-4 p-2 mb-lg-0 mb-3">
                        <div class="hstack gap-3">
                            <div class="p-2  rounded-circle bg-warning badge ">
                                <i class="fa-solid fa-cart-shopping color-white fs-5"></i>
                            </div>

                            <div class="p-2 ms-auto ">
                                <h4 class="fs-6 text-black-50 lh-1">SALES</h4>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- User Details End -->
@endsection

@section('modals')
@endsection

@push('js')
@endpush
