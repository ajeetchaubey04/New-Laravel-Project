{{-- Extends layout --}}
@extends('admin.layouts.app')

{{-- Required css --}}
@push('css')
    <link href="{{ asset('admin/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <!-- Switchery -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/switchery.css') }}" media="print" onload="this.media='all'">
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
                <a type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#add-bank-modal"
                    class="btn btn-primary btn-rounded">+ Add New Bank</a>

                <!-- Start Add Bank Modal -->
                <div class="modal fade" id="add-bank-modal" data-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered" bank="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Bank</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>

                            <form method="post" action="{{ route('admin.app-data.bank.store') }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-default bank" id="bank"
                                            name="title" required placeholder="Bank Name">
                                    </div>

                                    <div class="form-group">
                                        <input type="number" min="1" step='0.05' class="form-control input-default interest" id="interest"
                                            name="interest" required placeholder="Enter Interest">
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!-- End Add Bank Modal -->

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
                                <th>Bank</th>
                                <th>Interest</th>
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
                                    <td>#B-000{{ $id }}</td>
                                    <td>{{ $list->title }}</td>
                                    <td>{{ $list->interest }}</td>
                                    <td>
                                        {{ $list->activeControl(false, true) }}
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            @if ($list->trashed())
                                                <a href="javascript:void(0)"
                                                    class="btn btn-warning shadow btn-xs sharp  mr-1 ajax-request"
                                                    title="Restore"
                                                    data-url="{{ route('admin.app-data.bank.restore', $encoded_id) }}"
                                                    data-type="restore" data-reload="true" data-text="">
                                                    <i class="fa fa-recycle" aria-hidden="true"></i>
                                                </a>

                                                <a href="javascript:void(0)"
                                                    class="btn btn-danger shadow btn-xs sharp ajax-request"
                                                    title="Prmanently Delete"
                                                    data-url="{{ route('admin.app-data.bank.permanent-delete', $encoded_id) }}"
                                                    data-type="delete" data-reload="true"
                                                    data-text="You will not be able to recover this data !!">
                                                    <i class="fa fa-minus-circle" aria-hidden="true"></i>
                                                </a>
                                            @else
                                                <a href="javascript:void(0)"
                                                    class="btn btn-info shadow btn-xs sharp mr-1 ajax-request"
                                                    title="Edit"
                                                    data-url="{{ route('admin.app-data.bank.edit', $encoded_id) }}"
                                                    data-type="edit" data-reload="false" data-text="">
                                                    <i class="fa fa-pencil"></i>
                                                </a>

                                                <a href="javascript:void(0)"
                                                    class="btn btn-danger shadow btn-xs sharp ajax-request" title="Delete"
                                                    data-url="{{ route('admin.app-data.bank.permanent-delete', $encoded_id) }}"
                                                    data-type="delete" data-reload="true"
                                                    data-text="Only Admin can recover or delete permanently !!">
                                                    <i class="fa fa-trash"></i>
                                                </a>
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

    <div id="edit-ajax-data">

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

                                if (type == "edit") {
                                    $("#edit-ajax-data").empty().append(data.data);
                                    $("#edit-ajax-modal").modal("show");
                                    if($( "#edit-ajax-select" ).length){
                                        $("#edit-ajax-select").selectpicker();
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
                            toaster(err.message, 'Warning', 'warning');
                        }
                    });
                }(_this));
            }
        })(jQuery);
    </script>
@endpush
