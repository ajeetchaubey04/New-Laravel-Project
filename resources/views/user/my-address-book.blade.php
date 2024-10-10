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
@endpush

@section('content')
    <!-- User Details -->
    <section class="product-detail-section user-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrums">
                        <a href="/">Home</a> <span>></span> <a href="{{ route('user.my-account') }}">My Accoount</a>
                        <span>></span> My Address Book
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
                <div class="col-12 mt-2 text-end">
                    <button type="button" class="btn btn-success checkout" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        Add Address
                    </button>
                </div>
            </div>

            <div class="row">
                @foreach ($addresses as $address)
                    @php
                        $id = $address->id;
                        $encoded_id = base64_encode($id);
                    @endphp
                    <div class="col-md-6 mt-2">
                        <div class="card bg-white rounded-4 p-2 mb-lg-0 mb-3">
                            <div class="hstack gap-3">
                                <div class="p-2  rounded-circle badge badge-icon">
                                    <i class="fa fa-address-card color-white fs-5 d-inline-block w-16"></i>
                                </div>
                                <div class="p-2 ms-auto ">
                                    <h4 class="fs-6 text-black-50 lh-1 fw-bold">
                                        My Address
                                        <a href="javascript:void(0)" class="badge badge-danger badge-pill ajax-request"
                                            title="Delete Product"
                                            data-url="{{ route('user.delete-address', $encoded_id) }}" data-type="delete"
                                            data-reload="true" data-text="Delete permanently !!">
                                            <i class="fa fa-trash color-white fs-6 d-inline-block w-16"></i>
                                        </a>
                                    </h4>
                                </div>
                            </div>

                            <div class="gap-3 mt-2">
                                <p> <strong>Name: </strong> {{ $address->name }}</p>
                                <p><strong>Phone: </strong> {{ $address->phone }}</p>
                                <p><strong>Address: </strong> {{ $address->address }}, {{ $address->landmark }},
                                    {{ $address->state }}, {{ $address->city }}, {{ $address->pin_code }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- User Details End -->
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
