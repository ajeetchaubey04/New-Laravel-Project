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

            </div>
            <div class="input-group search-area ml-auto d-inline-flex mr-2">
                <input type="text" class="form-control" placeholder="Search here">
                <div class="input-group-append">
                    <button type="button" class="input-group-text">
                        <i class="flaticon-381-search-2"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <form method="post" action="{{ route('admin.general-settings') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control input-default" id="page" name="title" required
                                placeholder="Enter Email" value="{{ old('title', $page->title) }}">
                        </div>

                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" class="form-control input-default" id="post" name="post" required
                                placeholder="Enter Phone" value="{{ old('post', $page->post) }}">
                        </div>

                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" class="form-control input-default" id="description" name="description"
                                required placeholder="Enter Address" value="{{ old('description', $page->description) }}">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
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

    <!-- ckeditor5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>

    <script>
        (function($) {

            var allEditors = document.querySelectorAll('.ckeditor');
            for (var i = 0; i < allEditors.length; ++i) {
                ClassicEditor.create(
                    allEditors[i]
                );
            }

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

                                    if ($("#edit-ajax-select").length) {
                                        $("#edit-ajax-select").selectpicker();
                                    }
                                    if ($("#edit-ckeditor").length) {
                                        ClassicEditor.create(
                                            document.querySelector('#edit-ckeditor')
                                        );
                                    }
                                }
                                toaster(data.message, 'Success', 'success');

                                if (reload == true) {
                                    setTimeout(() => {
                                        page.reload();
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
