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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.bootstrap5.min.css"
        integrity="sha512-Ars0BmSwpsUJnWMw+KoUKGKunT7+T8NGK0ORRKj+HT8naZzLSIQoOSIIM3oyaJljgLxFi0xImI5oZkAWEFARSA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Sweetalert2 -->
    <link href="{{ asset('admin/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet" media="print"
        onload="this.media='all'">
    <style>
        .shopping-cart {
            width: 100%;
        }

        :root {
            --color-background: #fae3ea;
            --color-primary: #ff4e84;
            --font-family-base: Poppin, sans-serif;
            --font-size-h1: 1.25rem;
            --font-size-h2: 1rem;
        }

        html {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        address {
            font-style: normal;
            margin-bottom: 0%;
        }

        button {
            border: 0;
            color: inherit;
            cursor: pointer;
            font: inherit;
        }

        fieldset {
            border: 0;
            margin: 0;
            padding: 0;
        }

        h1 {
            font-size: 1.25rem;
            font-size: var(--font-size-h1);
            line-height: 1.2;
            margin-top: 0;
            margin-bottom: 1.5em;
        }

        h2 {
            font-size: 1rem;
            font-size: var(--font-size-h2);
            line-height: 1.2;
            margin-top: 0;
            margin-bottom: 0.5em;
        }

        legend {
            font-weight: 600;
            margin-bottom: 0.5em;
            padding: 0;
        }

        input {
            border: 0;
            color: inherit;
            font: inherit;
        }

        input[type="radio"] {
            accent-color: #fc8080;
            accent-color: var(--color-primary);
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        tbody {
            color: black;
        }

        td {
            padding-top: 0.125em;
            padding-bottom: 0.125em;
        }

        tfoot {
            border-top: 1px solid #b4b4b4;
            font-weight: 600;
        }

        .align {
            display: grid;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            justify-items: center;
            place-items: center;
        }

        .button {
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            background-color: #fc8080;
            background-color: var(--color-primary);
            border-radius: 999em;
            color: #fff;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            grid-gap: 0.5em;
            gap: 0.5em;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            padding-top: 0.75em;
            padding-bottom: 0.75em;
            padding-left: 1em;
            padding-right: 1em;
            -webkit-transition: 0.3s;
            -o-transition: 0.3s;
            transition: 0.3s;
        }

        .button:focus,
        .button:hover {
            background-color: #e96363;
        }

        .button--full {
            width: 100%;
        }

        .card {
            border-radius: 1em;
            background-color: #fc8080;
            background-color: var(--color-primary);
            color: #fff;
            padding: 1em;
        }

        .form {
            display: grid;
            grid-gap: 2em;
            gap: 2em;
        }

        .form__radios {
            display: grid;
            grid-gap: 1em;
            gap: 1em;
        }

        .form__radio {
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            background-color: #fefdfe;
            border-radius: 1em;
            -webkit-box-shadow: 0 0 1em rgba(0, 0, 0, 0.0625);
            box-shadow: 0 0 1em rgba(0, 0, 0, 0.0625);
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            padding: 1em;
        }

        .form__radio label {
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
            grid-gap: 1em;
            gap: 1em;
        }

        .header {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            padding-top: 0.5em;
            padding-bottom: 0.5em;
            padding-left: 1em;
            padding-right: 1em;
        }

        .icon {
            height: 1em;
            display: inline-block;
            fill: currentColor;
            width: 1em;
            vertical-align: middle;
        }

        .iphone {
            background-color: #fbf6f7;
            background-image: -webkit-gradient(linear, left top, left bottom, from(#fbf6f7), to(#fff));
            background-image: -o-linear-gradient(top, #fbf6f7, #fff);
            background-image: linear-gradient(to bottom, #f8f9fa, #ff4e84);
            border-radius: 2em;
            height: 812px;
            -webkit-box-shadow: 0 0 1em rgba(0, 0, 0, 0.0625);
            box-shadow: 0 0 1em rgba(0, 0, 0, 0.0625);
            overflow: auto;
            padding: 2em;
        }

        .paytm {
            width: 30px
        }
    </style>
@endpush

@section('content')
    <!-- User Details -->
    <section class="product-detail-section user-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrums">
                        <a href="/">Home</a> <span>></span> <a href="{{ route('user.my-account') }}">My Accoount</a>
                        <span>></span> Checkout
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- User Details End -->

    <!-- checkout Details -->
    <div class="d-flex justify-content-center align-items-center user-details">
        <div class="container p-3">

            <div class="row">
                <div class="col-md-8">
                    <div class="shopping-cart">
                        <!-- Title -->
                        <div class="title">
                            Your Items
                        </div>
                        <div id="cart">
                            @include('partials.cart-items')
                        </div>
                    </div>
                </div>

                <div class="col-md-4" id="checkout">
                    @include('user.checkout-total')
                </div>
            </div>
        </div>
    </div>
    <!-- checkout Details End -->
@endsection

@section('modals')
    <!-- Address Form -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="" method="POST" action="{{ route('user.add-address') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="staticBackdropLabel">Add Address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Name"
                                    maxlength="100" required>
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Phone</label>
                                <input type="text" class="form-control disablecopypaste" name="phone"
                                    onkeypress="return /[0-9]/i.test(event.key)" maxlength="10"
                                    placeholder="Enter Phone Number" required>
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" placeholder="Enter Address"
                                    maxlength="200" required>
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Landmark</label>
                                <input type="text" class="form-control" name="landmark" maxlength="200"
                                    placeholder="Enter Landmark" required>
                            </div>
                            <div class="col-4">
                                <label for="" class="form-label">City</label>
                                <input type="text" id="select-city" class="form-control" name="city"
                                    placeholder="Enter City" required>
                            </div>
                            <div class="col-4">
                                <label for="" class="form-label">State</label>
                                <input type="text" id="select-state" class="form-control" name="state"
                                    placeholder="Enter State" required>
                            </div>
                            <div class="col-4">
                                <label for="" class="form-label">Pincode</label>
                                <input type="text" id="select-zip" class="form-control" name="pin_code"
                                    placeholder="Enter City" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary checkout" type="submit">Save</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@push('js')
    <!-- Sweetalert2 -->
    <script src="{{ asset('admin/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
        integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function() {

            $('input.disablecopypaste').bind('copy paste', function(e) {
                e.preventDefault();
            });

            $("#select-city").selectize({
                maxItems: 1,
                valueField: "name",
                labelField: "name",
                searchField: ["name"],
                options: [{
                        value: "1",
                        name: "Chandigarh"
                    },
                    {
                        value: "2",
                        name: "Mohali"
                    },
                    {
                        value: "3",
                        name: "Zirakpur"
                    },
                    {
                        value: "3",
                        name: "Panchkula"
                    },
                ],
            });

            $("#select-state").selectize({
                maxItems: 1,
                valueField: "name",
                labelField: "name",
                searchField: ["name"],
                options: [{
                        value: "1",
                        name: "Chandigarh"
                    },
                    {
                        value: "2",
                        name: "Punjab"
                    },
                    {
                        value: "3",
                        name: "Haryana"
                    },
                ],
            });

            $("#select-zip").selectize({
                maxItems: 1,
                valueField: "name",
                labelField: "name",
                searchField: ["name"],
                options: [{
                        value: "1",
                        name: "123233"
                    },
                    {
                        value: "2",
                        name: "123121"
                    },
                    {
                        value: "3",
                        name: "123112"
                    },
                ],
            });

            const $parent = $(document.body);

            $parent.on('click', '.ajax-request', function(ev) {
                const $this = $(this);
                const {
                    url,
                    type,
                    text,
                    reload,
                } = $this.data();

                if (type === 'delete') {
                    swal({
                        title: "Are you sure to delete?",
                        text: text,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it !!",
                    }).then((result) => {
                        if (!result.value) return;

                        if (url && url.length) {
                            // ajax_request($this, url, true);
                            window.location.href = url;
                        }
                    });
                } else if (url && url.length) {
                    // ajax_request($this, url, reload, type);
                }
            });
        });
    </script>
@endpush
