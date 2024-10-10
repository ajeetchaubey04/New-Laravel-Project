{{-- Extends layout --}}
@extends('admin.layouts.app')

{{-- Required css --}}
@push('css')
    <link href="{{ asset('admin/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <!-- Switchery -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/switchery.css') }}" media="print"
        onload="this.media='all'">
    <!-- Sweetalert2 -->
    <link href="{{ asset('admin/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet" media="print"
        onload="this.media='all'">
@endpush

{{-- Toast --}}
@include('admin.partials.toaster')

{{-- Content --}}
@section('content')
    <!-- row -->
    <div class="container-fluid">
        <div class="form-head d-flex mb-3 mb-md-4 align-items-start">
            <div class="mr-auto d-lg-block">

                {{-- @if (auth()->user()->isRetailer()) --}}
                    <a type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#add-user-modal"
                        class="btn btn-primary btn-rounded">+ Add Request</a>

                    <!-- Start Add Request Modal -->
                    <div class="modal fade" id="add-user-modal" data-backdrop="static">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Request</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                    </button>
                                </div>

                                <form method="post" action="{{ route('admin.request.store') }}"
                                    enctype="multipart/form-data" autocomplete="off">
                                    @csrf

                                    <div class="modal-body">

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-default name"
                                                        name="name" required placeholder="Name"
                                                        value="{{ old('name') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="email" class="form-control input-default email"
                                                        name="email" required placeholder="Email"
                                                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                                                        value="{{ old('email') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-default phone"
                                                        name="phone" required placeholder="Phone" maxlength="10"
                                                        value="{{ old('phone') }}" pattern="[0-9]{10}"
                                                        title="Please enter valid 10 Digit Mobile No. E.g. 9103180340"
                                                        onkeypress="return /[0-9]/i.test(event.key)">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-default alternate_phone"
                                                        name="alternate_phone" required placeholder="Alternate Phone" maxlength="10"
                                                        value="{{ old('alternate_phone') }}"
                                                        onkeypress="return /[0-9]/i.test(event.key)">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-default occupation" name="occupation"
                                                        required placeholder="Occupation"
                                                        value="{{ old('occupation') }}"
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-default adhar_card_no"
                                                        name="adhar_card_no" required placeholder="Adhar Number"
                                                        onkeypress="return /[0-9]/i.test(event.key)" maxlength="12"
                                                        pattern="[0-9]{12}"
                                                        title="Please enter valid Adhar number. E.g. 3912 2781 2501"
                                                        value="{{ old('adhar_card_no') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-default pan_card_no"
                                                        name="pan_card_no" required placeholder="Pan Number" maxlength="10"
                                                        oninput="this.value = this.value.toUpperCase()"
                                                        pattern="[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}"
                                                        title="Please enter valid PAN number. E.g. AAAAA9999A"
                                                        value="{{ old('pan_card_no') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-default price"
                                                        name="price" required placeholder="Price"
                                                        onkeypress="return /[0-9]/i.test(event.key)" maxlength="10"
                                                        value="{{ old('price') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-default down_payment"
                                                        name="down_payment" required placeholder="Down Payment"
                                                        onkeypress="return /[0-9]/i.test(event.key)" maxlength="10"
                                                        value="{{ old('down_payment') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-default emi_months"
                                                        name="emi_months" required placeholder="Emi Months"
                                                        onkeypress="return /[0-9]/i.test(event.key)" maxlength="2"
                                                        value="{{ old('emi_months') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select class="multi-select" required name="bank_id"
                                                        data-live-search="true" data-width="100%">
                                                        @foreach ($banks as $bank)
                                                            <option {{ old('bank_name') == $bank->id ? 'selected' : '' }}
                                                                value="{{ $bank->id }}">{{ $bank->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-default finance_type_id"
                                                        name="finance_type_id" required placeholder="Finance Type"
                                                        value="{{ old('finance_type_id') }}">
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="custom-file">
                                                        <input required type="file" class="custom-file-input"
                                                            name="request_adhar_front_img" accept="image/*">
                                                        <label class="custom-file-label">Adhar Front</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="custom-file">
                                                        <input required type="file" class="custom-file-input"
                                                            name="request_adhar_back_img" accept="image/*">
                                                        <label class="custom-file-label">Adhar Back</label>
                                                    </div>
                                                </div>
                                            </div> --}}

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger light"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- End Add Request Modal -->
                {{-- @endif --}}

            </div>
            <div class="input-group search-area ml-auto d-inline-flex mr-2">
                <input type="text" class="form-control" placeholder="Search here">
                <div class="input-group-append">
                    <button type="button" class="input-group-text"><i class="flaticon-381-search-2"></i></button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="table-responsive">
                    <table id="permission-table" class="table shadow-hover  table-bordered mb-4 dataTablesCard fs-14">
                        <thead>
                            <tr>
                                <th>
                                    <div class="checkbox align-self-center">
                                        <div class="custom-control custom-checkbox ">
                                            <input type="checkbox" class="custom-control-input" id="checkAll"
                                                required="">
                                            <label class="custom-control-label" for="checkAll"></label>
                                        </div>
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>Name</th>
                                {{-- @if (auth()->user()->isAdmin()) --}}
                                    <th>Sales Name</th>
                                    <th>Sales Number</th>
                                {{-- @endif --}}
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($lists as $list)
                                @php
                                    $id = $list->id;
                                    $encoded_id = base64_encode($id);
                                    $satus = $list->status;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="checkbox text-right align-self-center">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="list_{{ $id }}" required="">
                                                    <label class="custom-control-label"
                                                        for="list_{{ $id }}"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>#RQ-000{{ $id }}</td>
                                    <td>{{ $list->name }}</td>
                                    <td>{{ $list->sale->name ?? '' }}</td>
                                    <td>{{ $list->sale->phone ?? '' }}</td>
                                    <td>{{ $list->price }}</td>
                                    <td>
                                        {{-- {{ $list->activeControl(false, true) }} --}}
                                        @if ($list->status == 0)
                                            <span class="badge light badge-warning">Pending</span>
                                        @endif
                                        @if ($list->status == 1)
                                            <span class="badge light badge-success">Accepted</span>
                                        @endif
                                        @if ($list->status == 2)
                                            <span class="badge light badge-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            @if ($list->trashed())
                                                <a href="javascript:void(0)"
                                                    class="btn btn-warning shadow btn-xs sharp  mr-1 ajax-request"
                                                    title="Restore"
                                                    data-url="{{ route('admin.request.restore', $encoded_id) }}"
                                                    data-type="restore" data-reload="true" data-text="">
                                                    <i class="fa fa-recycle" aria-hidden="true"></i>
                                                </a>

                                                <a href="javascript:void(0)"
                                                    class="btn btn-danger shadow btn-xs sharp ajax-request"
                                                    title="Prmanently Delete"
                                                    data-url="{{ route('admin.request.permanent-delete', $encoded_id) }}"
                                                    data-type="delete" data-reload="true"
                                                    data-text="You will not be able to recover this data !!">
                                                    <i class="fa fa-minus-circle" aria-hidden="true"></i>
                                                </a>
                                            @else
                                                @if ($list->status == 0 && auth()->user()->isAdmin())
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-success shadow btn-xs sharp mr-1 ajax-request"
                                                        title="Accept"
                                                        data-url="{{ route('admin.request.status', ['id' => $encoded_id, 'value' => 1]) }}"
                                                        data-type="accept" data-reload="true" data-text="">
                                                        <i class="fa fa-check"></i>
                                                    </a>

                                                    <a href="javascript:void(0)"
                                                        class="btn btn-danger shadow btn-xs sharp mr-1 ajax-request"
                                                        title="Reject"
                                                        data-url="{{ route('admin.request.status', ['id' => $encoded_id, 'value' => 2]) }}"
                                                        data-type="reject" data-reload="true" data-text="">
                                                        <i class="fa fa-times"></i>
                                                    </a>

                                                    <a href="javascript:void(0)"
                                                        class="btn btn-success shadow btn-xs sharp mr-1 ajax-request"
                                                        title="Show"
                                                        data-url="{{ route('admin.request.show', $encoded_id) }}"
                                                        data-type="show" data-reload="false" data-text="">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-success shadow btn-xs sharp mr-1 ajax-request"
                                                        title="Show"
                                                        data-url="{{ route('admin.request.show', $encoded_id) }}"
                                                        data-type="show" data-reload="false" data-text="">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-info shadow btn-xs sharp mr-1 ajax-request"
                                                        title="Edit"
                                                        data-url="{{ route('admin.request.edit', $encoded_id) }}"
                                                        data-type="edit" data-reload="false" data-text="">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>

                                                    <a href="javascript:void(0)"
                                                        class="btn btn-danger shadow btn-xs sharp ajax-request"
                                                        title="Delete"
                                                        data-url="{{ route('admin.request.delete', $encoded_id) }}"
                                                        data-type="delete" data-reload="true"
                                                        data-text="Only Admin can recover or delete permanently !!">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No record found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $lists->links('admin.partials.pagination') }}
                </div>
            </div>
        </div>
    </div>

    <div id="edit-ajax">

    </div>
@endsection

{{-- Required js --}}
@push('js')
    <!-- Datatable -->
    {{-- <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script> --}}

    <!-- Switchery -->
    <script type="text/javascript" src="{{ asset('admin/js/switchery.js') }}"></script>

    <!-- Sweetalert2 -->
    <script src="{{ asset('admin/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>

    <script>
        function passwordShowHide() {
            let password = $('.password');
            if (password.prop('type') == 'text') {
                $
                password.prop("type", "password");
            } else {
                password.prop("type", "text");
            }
        }

        (function($) {
            $('.switchery').each(function(index, item) {
                var _switch = new Switchery(item, {
                    size: 'small',
                    // color:'#369dc9',
                    secondaryColor: '#bc1616',
                    speed: '0.1s',
                });

                $(item).on('change', function(ev) {
                    var url = $(this).data('url');
                    if (url && url.length) {
                        ajax_request($(this), url);
                    }
                });
            });

            $('.ajax-request').each(function(index, item) {
                $(item).on('click', function(ev) {
                    var url = $(this).data('url');
                    var type = $(this).data('type');
                    var text = $(this).data('text');
                    var reload = $(this).data('reload');

                    if (type == 'delete') {
                        swal({
                            title: "Are you sure to delete ?",
                            text: text,
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Yes, delete it !!",
                        }).then((result) => {
                            if (result.value) {
                                if (url && url.length) {
                                    ajax_request($(this), url, true);
                                }
                            }
                        })
                    } else {
                        if (url && url.length) {
                            ajax_request($(this), url, reload, type);
                        }
                    }
                });
            });

            function ajax_request(_this, url, reload = false, type = "") {
                (function(_this) {
                    $.ajax({
                        url: url,
                        success: function(data) {
                            if (data.success) {

                                if (type == "edit" || type == "show") {
                                    $("#edit-ajax").empty().append(data.data);
                                    $("#edit-ajax-modal").modal("show");
                                    if ($(".edit-ajax-select").length) {
                                        $(".edit-ajax-select").selectpicker();
                                    }
                                }
                                toaster(data.message, 'Success', 'success');

                                if (reload == true) {
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1500);
                                }
                            } else {
                                toaster(data.message, 'Error', 'danger');
                            }
                        },
                        error: function(err) {
                            toaster('Something Went Wrong', 'Warning', 'warning');
                        }
                    });
                }(_this));
            }

            $('.phone').bind('copy paste', function(e) {
                e.preventDefault();
            });

        })(jQuery);
    </script>
@endpush
