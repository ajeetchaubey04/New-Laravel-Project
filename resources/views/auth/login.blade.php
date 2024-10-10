@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center card-title">Sign in your Account</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox ml-1">
                                        <input type="checkbox" name="active" class="custom-control-input"
                                            id="basic_checkbox_1">
                                        <label class="custom-control-label" for="basic_checkbox_1">Remember my
                                            preference</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <a href="{{ route('user.register') }}">Register</a>
                                    {{-- <a href="{{ route('user.reset-password.get') }}">Forgot Password?</a> --}}
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Sign Me In</button>
                            </div>
                            <div class="google-login">
                                <a href="{{ route('auth.google') }}">
                                    <img src="{{ asset('website/img/google-login.png') }}">
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
