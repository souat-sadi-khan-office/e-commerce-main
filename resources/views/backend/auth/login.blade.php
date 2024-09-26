@extends('backend.layouts.auth')

@section('title', 'Login')

@section('content')
<div class="login-form-container">
    <h2>Login</h2>
    
    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Login Form -->
    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" class="form-control" id="email" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>

        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>

    </form>
</div>
@endsection
