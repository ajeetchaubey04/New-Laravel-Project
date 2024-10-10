{{-- Extends layout --}}
@extends('admin.layouts.fullwidth')

{{-- Toast --}}
@include('admin.partials.toaster')

{{-- Content --}}
@section('content')
    <div class="col-md-6">
        <div class="authincation-content">
            <div class="row no-gutters">
                <div class="col-xl-12">
                    <div class="auth-form text-center">
                        <img src="{{ asset('admin/images/restricted.png') }}" alt="">
                        <h2 class="mb-4">Account Restricted</h2>
                        <a href="{{ route('admin.login') }}" class="btn btn-primary btn-block">Log In</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
