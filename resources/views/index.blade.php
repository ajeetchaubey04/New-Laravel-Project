@extends('layouts.app')

@push('css')
    <style>
        .quick-link-item {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: start;
            justify-content: start;
            padding-left: 20px;
        }

        .quick-link-item .qli-title {
            font-family: "Poppins", sans-serif;
            font-style: normal;
            font-weight: 800;
            font-size: 23px;
            line-height: 16px;
            color: #000000;
            opacity: 1;
            margin-bottom: 8px;
            padding-left: 20px;
        }

        .qli-content {
            width: 100%;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 15px;
            line-height: 1.5;
            padding-left: 23px;
            padding-top: 25px;
        }

        .qli-links {
            color: #d78dff;
            margin: 2px;
        }

        .table {
            overflow-x: auto;
            max-width: 100%;
        }

        /* Card Layout */
        .seller-image-bx {
            display: block;
            text-align: center;
            text-decoration: none;
            background: #fff;
            border: 1px solid #d78dff;
            border-radius: 6px;
            box-shadow: 0 3px 7px rgba(37, 47, 61, .6);
            padding: 1rem;
            transition: all 0.3s ease-in-out;
        }

        .seller-image-bx p {
            margin-top: 1rem;
            font-size: 1rem;
            color: #333;
        }

        /* Image Container for Hover Effect */
        .image-container {
            overflow: hidden;
            border-radius: inherit;
            position: relative;
        }

        .bestcake-image {
            width: 100%;
            height: auto;
            transition: transform 0.5s ease;
            display: block;
        }

        /* Hover Effect: Zoom In and Out */
        .seller-image-bx:hover .bestcake-image {
            transform: scale(1.1);
        }

        .seller-image-bx:hover {
            box-shadow: 0 5px 10px rgba(37, 47, 61, .8);
        }
    </style>
@endpush

@section('meta')
    <title>Shyam Lal Sweets Bhandar</title>
    <meta content="Sample description" name="description">
    <meta content="Sample keywords" name="keywords">
    <link rel="canonical" href="{{ request()->url() }}" />
@endsection

@section('content')
    <!-- Best Seller Section -->
    <section class="best-seller yummy-cake-sec">
        <div class="container">
            <div class="row row-gap-4 justify-content-center">
                <div class="col-12">
                    <h2>Apple Mobiles</h2>
                </div>
                @foreach ($products as $product)
                    <!-- Use singular $product in the loop -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <a href="javascript:void(0)" class="seller-image-bx">
                            <div class="image-container">
                                @if ($product->featuredImage)
                                    <!-- Display the product's featured image -->
                                    <img src="{{ asset($product->featuredImage->file) }}" alt="{{ $product->name }}"
                                        class="bestcake-image">
                                @else
                                    <!-- Fallback to a placeholder image if no image is available -->
                                    <img src="{{ asset('website/img/mechanised-tools-website-adapt.webp') }}"
                                        alt="Placeholder Image" class="bestcake-image">
                                @endif
                            </div>
                            <p class="item-title">{{ $product->name }}</p>
                            <p class="mb-0"><span>₹ {{ $product->price }}</span></p>
                            <p class="item-title">{{ $product->description }}</p>

                        </a>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
@endsection
