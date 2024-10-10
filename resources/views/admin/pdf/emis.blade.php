{{-- Extends layout --}}
@extends('admin.pdf.layout')

{{-- Content --}}
@section('content')
    <!-- row -->
    <div class="container-fluid">

        <div class="row">   
            <div class="col-xl-12">
                <div class="table-responsive">
                    <table id="permission-table" class="table shadow-hover  table-bordered mb-4 dataTablesCard fs-14">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Mobile No.</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($lists as $list)
                                @php
                                    $id = $list->id;
                                    $encoded_id = base64_encode($id);
                                    $status = $list->status;
                                @endphp
                                <tr>
                                    <td>#EMI-000{{ $list->emi_seq }}</td>
                                    <td>{{ $list->client->name }}</td>
                                    <td>{{ $list->client->phone }}</td>
                                    <td style="font-family: DejaVu Sans; sans-serif;">&#8377; {{ $list->emi_amount }}</td>
                                    <td>{{ $list->emi_month }}</td>
                                    <td>
                                        @if ($status == 'pending')
                                            <span class="badge badge-warning" style="background-color: rgba(255, 184, 0, 0.1);color:#ffb800">Pending</span>
                                        @endif
                                        @if ($status == 'paid')
                                            <span class="badge badge-success"  style="color:#2bc155">Completed</span>
                                        @endif
                                        @if ($status == 'failed')
                                            <span class="badge badge-danger"  style="color:#f46b68">Failed</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No record found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

