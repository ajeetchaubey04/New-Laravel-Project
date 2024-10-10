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
    <!-- ckeditor5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-font@36.0.1/theme/fontcolor.min.css"
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
                <a type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#add-membership-modal"
                    class="btn btn-primary btn-rounded">+ Add Membership Plan</a>

                <!-- Start Add Membership Modal -->
                <div class="modal fade" data-focus="false" id="add-membership-modal" data-focus="false"
                    data-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Membership Plan</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>

                            <form method="post" action="{{ route('admin.membership.store') }}" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-default name"
                                            value="{{ old('name') }}" name="name" required placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control input-default email"
                                            value="{{ old('email') }}" name="email" required placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control input-default phoneno"
                                            value="{{ old('phoneno') }}" name="phoneno" required placeholder="Phone No.">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control input-default membershiptype"
                                            value="{{ old('membershiptype') }}" name="membershiptype" required
                                            placeholder="Membership Type">
                                    </div>
                                    <div class="form-group">
                                        <input type="date" class="form-control input-default dob"
                                            value="{{ old('dob') }}" name="dob" required placeholder="Date Of Birth">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control input-default country"
                                            value="{{ old('country') }}" name="country" required placeholder="Country">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control input-default ckeditor" name="message" cols="60" rows="8"
                                            placeholder="Message">{{ old('message') }}</textarea>
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
                <!-- End Add Membership Modal -->
            </div>

            <form action="{{ route('admin.membership.index') }}" method="get">
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
                                <th>Email</th>
                                <th>Message</th>
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
                                    <td>#HAD-000{{ $id }}</td>
                                    <td>{{ $list->name }}</td>
                                    <td>{{ $list->email }}</td>
                                    <td>{{ $list->message }}</td>
                                    <td>
                                        <div class="d-flex">
                                            @if ($list->trashed())
                                                <a href="javascript:void(0)"
                                                    class="btn btn-warning shadow btn-xs sharp  mr-1 ajax-request"
                                                    title="Restore Product"
                                                    data-url="{{ route('admin.membership.restore', $encoded_id) }}"
                                                    data-type="restore" data-reload="true" data-text="">
                                                    <i class="fa fa-recycle" aria-hidden="true"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-danger shadow btn-xs sharp ajax-request"
                                                    title="Prmanently Delete Product"
                                                    data-url="{{ route('admin.membership.permanent-delete', $encoded_id) }}"
                                                    data-type="delete" data-reload="true"
                                                    data-text="You will not be able to recover this data !!">
                                                    <i class="fa fa-minus-circle" aria-hidden="true"></i>
                                                </a>
                                            @else
                                                <a href="javascript:void(0)"
                                                    class="btn btn-primary shadow btn-xs sharp mr-1 ajax-request"
                                                    title="Show Product"
                                                    data-url="{{ route('admin.membership.show', $encoded_id) }}"
                                                    data-type="show" data-reload="false" data-text="">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-info shadow btn-xs sharp mr-1 ajax-request"
                                                    title="Edit Product"
                                                    data-url="{{ route('admin.membership.edit', $encoded_id) }}"
                                                    data-type="edit" data-reload="false" data-text="">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-danger shadow btn-xs sharp  mr-1 ajax-request"
                                                    title="Delete Product"
                                                    data-url="{{ route('admin.membership.delete', $encoded_id) }}"
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

    <!-- ckeditor5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script>
        (function($) {

            var headingData = {
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        },
                        {
                            model: 'heading3',
                            view: 'h3',
                            title: 'Heading 3',
                            class: 'ck-heading_heading3'
                        }
                    ]
                }
            };

            var allEditors = document.querySelectorAll('.ckeditor');
            for (var i = 0; i < allEditors.length; ++i) {
                ClassicEditor.create(
                    allEditors[i], headingData
                );
            }

            $('.slug').keyup(function() {
                $(this).val(slugGen($(this).val()));
            });

            $('input.title').change(function() {
                $('.slug').val(slugGen($(this).val()));
            });

            const slugGen = (text) => {
                let Text = text;
                Text = Text.toLowerCase();
                Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
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
                        status,
                    } = $switch.data();

                    if (url && url.length) {
                        ajax_request($switch, url, false, type, id, status);
                        $switch.data('status', status == 1 ? 0 : 1);
                    }
                });

                $switches.each((index, item) => {
                    const switchery = new Switchery(item, {
                        size: 'small',
                        // color:'#369dc9',
                        secondaryColor: '#bc1616',
                        speed: '0.1s',
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
                                        ClassicEditor.create(
                                            allEditors[i], headingData
                                        );
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
