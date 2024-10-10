@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center card-title">Sign up your Account</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.register') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="form-label">Username:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="form-label">Phone:</label>
                                <input type="text" class="form-control" id="phone" name="phone" required
                                    maxlength="10" onkeypress="return /[0-9]/i.test(event.key)">
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Sign me up</button>
                            </div>
                        </form>
                        <div class="new-account mt-3">
                            <p>Already have an account? <a class="text-primary" href="{{ route('user.login') }}">Sign in</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
