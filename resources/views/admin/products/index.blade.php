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
                <a type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#add-product-modal"
                    class="btn btn-primary btn-rounded">+ Add New Products</a>
                <!-- Start Product Section Modal -->

                <div class="modal fade" data-focus="false" id="add-product-modal" data-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Products</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <form method="post" action="{{ route('admin.products.store') }}" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-default name"
                                            value="{{ old('name') }}" name="name" required placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control input-default description"
                                            value="{{ old('description') }}" name="description" required
                                            placeholder="Description">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control input-default price"
                                            value="{{ old('price') }}" name="price" required placeholder="Price">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control input-default quantity"
                                            value="{{ old('quantity') }}" name="quantity" required placeholder="Quantity">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" required
                                                name="request_featured_product" accept=".png, .jpg, .jpeg, .webp">
                                            <label class="custom-file-label">Featured banner</label>
                                        </div>
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
                <!-- End Add Writer Section Modal -->
            </div>

            <form action="{{ route('admin.products.index') }}" method="get">
                <div class="input-group search-area ml-auto d-inline-flex mr-2">
                    <input name="query" type="text" class="form-control" placeholder="Search here"
                        value="{{ app('request')->input('query') }}">
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text"><i class="flaticon-381-search-2"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="table-responsive">
                    <table id="permission-table" class="table shadow-hover table-bordered mb-4 dataTablesCard fs-14">
                        <thead>
                            <tr>
                                <th>
                                    <div class="checkbox align-self-center">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkAll"
                                                required="">
                                            <label class="custom-control-label" for="checkAll"></label>
                                        </div>
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Images</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($lists as $list)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="checkbox text-right align-self-center">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="list_{{ $list->id }}" required="">
                                                    <label class="custom-control-label"
                                                        for="list_{{ $list->id }}"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>#Prod-000{{ $list->id }}</td>
                                    <td>{{ $list->name }}</td>
                                    <td>{{ $list->description }}</td>
                                    <td>{{ $list->price }}</td>
                                    <td>{{ $list->quantity }}</td>
                                    @if ($list->featuredImage)
                                        <td>
                                            <a href="{{ asset($list->featuredImage->file) }}" target="_blank">
                                                <img loading="lazy" src="{{ asset($list->featuredImage->file) }}"
                                                    width="40px" alt="{{ $list->name }}">
                                            </a>
                                        </td>
                                    @else
                                        <td>N/A</td>
                                    @endif


                                    <td>
                                        <div class="d-flex">
                                            @if ($list->trashed())
                                                <a href="javascript:void(0)"
                                                    class="btn btn-warning shadow btn-xs sharp mr-1 ajax-request"
                                                    title="Restore Product"
                                                    data-url="{{ route('admin.products.restore', base64_encode($list->id)) }}"
                                                    data-type="restore" data-reload="true" data-text="">
                                                    <i class="fa fa-recycle" aria-hidden="true"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-danger shadow btn-xs sharp ajax-request"
                                                    title="Permanently Delete Product"
                                                    data-url="{{ route('admin.products.permanent-delete', base64_encode($list->id)) }}"
                                                    data-type="delete" data-reload="true"
                                                    data-text="You will not be able to recover this data !!">
                                                    <i class="fa fa-minus-circle" aria-hidden="true"></i>
                                                </a>
                                            @else
                                                <a href="javascript:void(0)"
                                                    class="btn btn-primary shadow btn-xs sharp mr-1 ajax-request"
                                                    title="Show Product"
                                                    data-url="{{ route('admin.products.show', base64_encode($list->id)) }}"
                                                    data-type="show" data-reload="false" data-text="">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-info shadow btn-xs sharp mr-1 ajax-request"
                                                    title="Edit Product"
                                                    data-url="{{ route('admin.products.edit', base64_encode($list->id)) }}"
                                                    data-type="edit" data-reload="false" data-text="">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-danger shadow btn-xs sharp mr-1 ajax-request"
                                                    title="Delete Product"
                                                    data-url="{{ route('admin.products.delete', base64_encode($list->id)) }}"
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
                                    <td colspan="9" class="text-center">No record found</td>
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
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}


    <!-- Sweetalert2 -->
    <script src="{{ asset('admin/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>

    <!-- ckeditor5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            $('#course').change(function() {
                var courseId = $(this).val();
                console.log('Selected Course ID:', courseId);
                fetchCoursePages(courseId);
            });
        });

        function fetchCoursePages(courseId) {
            if (courseId) {
                $.ajax({
                    url: '{{ route('admin.coursedata.fetchSubCourses', ':courseId') }}'.replace(':courseId',
                        courseId),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var coursePageDropdown = $('select#course_pagess');
                        coursePageDropdown.empty();
                        coursePageDropdown.append('<option value="">Select Course Page</option>');
                        $.each(data, function(key, value) {
                            coursePageDropdown.append('<option value="' + value.id + '">' + value
                                .course_page + '</option>');
                        });
                        // Refresh the Bootstrap select
                        coursePageDropdown.selectpicker('refresh');
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                    }
                });
            } else {
                $('#course_pagess').empty().append('<option value="">Select Course Page</option>').selectpicker('refresh');
            }
        }
    </script>
    {{-- function fetchCoursePages(courseId) {
        if (courseId) {
            console.log('Fetching course pages for courseId:', courseId);
            $.ajax({
                url: '{{ route('admin.coursedata.fetchSubCourses', ':courseId') }}'.replace(':courseId',
                    courseId),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log('Data received:', data);
                    var coursePageDropdown = $('select#course_pagess');
                    coursePageDropdown.empty(); // Clear existing options
                    //coursePageDropdown.append(
                    //    '<option value="">Select Course Page</option>'); // Add default option
                    var alloptions = '';
                    alloptions += '<option value="">Select Course Page</option>';
                    // Append new options from response data
                    $.each(data, function(key, value) {
                        console.log('Appending option:', value);
                        alloptions += '<option value="' + value.id + '">' + value.course_page +
                            '</option>';
                        //  coursePageDropdown.append('<option value="' + value.id + '">' + value
                        //  .course_page + '</option>');
                    });

                    // alert(alloptions);
                    console.log(coursePageDropdown);
                    $('select#course_pagess').html(alloptions);

                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        } else {
            $('#course_page').empty();
            $('#course_page').append(
                '<option value="">Select Course Page</option>'); // Add default option if no course is selected
        }
    } --}}

    <script>
        (function($) {
            var allEditors = document.querySelectorAll('.ckeditor');
            for (var i = 0; i < allEditors.length; ++i) {
                ClassicEditor.create(allEditors[i]);
            }

            $('.slug').keyup(function() {
                $(this).val(slugGen($(this).val()));
            });

            $('input.title').change(function() {
                $('.slug').val(slugGen($(this).val()));
            });

            const slugGen = (text) => {
                let Text = text.toLowerCase().replace(/[^a-zA-Z0-9]+/g, '-');
                return Text;
            }

            function switcheryInit() {
                const $switches = $('.switchery');
                const $switchParent = $switches.parent();

                $switchParent.on('change', '.switchery', ev => {
                    const $switch = $(ev.target);
                    const {
                        url,
                        type,
                        id,
                        status
                    } = $switch.data();

                    if (url && url.length) {
                        ajax_request($switch, url, false, type, id, status);
                        $switch.data('status', status == 1 ? 0 : 1);
                    }
                });

                $switches.each((index, item) => {
                    new Switchery(item, {
                        size: 'small',
                        secondaryColor: '#bc1616',
                        speed: '0.1s'
                    });
                });
            }

            switcheryInit();

            const $parent = $(document.body);

            $parent.on('click', '.ajax-request', function(ev) {
                const $this = $(this);
                const {
                    url,
                    type,
                    text,
                    reload
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
                            ajax_request($this, url, true);
                        }
                    });
                } else if (url && url.length) {
                    ajax_request($this, url, reload, type);
                }
            });

            function ajax_request(_this, url, reload = false, type = "", id = "", status = "") {
                $.ajax({
                    url,
                    success: (data) => {
                        if (data.success) {
                            if (type === "edit" || type === "show" || type === 'meta') {
                                $("#edit-ajax").empty().append(data.data);
                                $("#edit-ajax-modal").modal("show");
                                if ($(".edit-ajax-select").length) {
                                    $(".edit-ajax-select").selectpicker();
                                }
                                if ($(".ckeditor").length) {
                                    let allEditors = document.querySelectorAll('.ckeditor');
                                    for (var i = 0; i < allEditors.length; ++i) {
                                        ClassicEditor.create(allEditors[i]);
                                    }
                                }
                            }
                            toaster(data.message, 'Success', 'success');
                            if (reload) {
                                setTimeout(() => {
                                    location.reload();
                                }, 1500);
                            }
                        } else {
                            toaster(data.message, 'Error', 'danger');
                        }
                    },
                    error: (err) => {
                        toaster('Something Went Wrong', 'Warning', 'warning');
                    }
                });
            }
        })(jQuery);
    </script>
@endpush
