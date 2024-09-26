@extends('backend.layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="login-box">
        <div class="card card-outline">
            <div class="text-center card-header"> 
                <a href="{{ route('home') }}">
                    <img src="https://bestwebcreator.com/shopwise/demo/assets/images/logo_dark.png" alt="Logo" style="width:150px;">
                </a> 
            </div>
            <div class="card-body login-card-body">
                
                <div class="text-center">
                    <h2>Welcome to E-commerce Project</h2>
                    <p class="login-box-msg">Sign in to start your session</p>
                </div>

                @if (isset($errors) && $errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.login.post') }}" method="post">
                    @csrf

                    <div class="input-group mb-1">
                        <div class="form-floating"> 
                            <input id="email" type="email" class="form-control" name="email" required> 
                            <label for="email">Email</label> 
                        </div>
                        <div class="input-group-text"> 
                            <span class="bi bi-envelope"></span> 
                        </div>
                    </div>

                    <div class="input-group mb-1">
                        <div class="form-floating"> 
                            <input id="password" name="password" required type="password" class="form-control"> 
                            <label for="password">Password</label> 
                        </div>
                        <div class="input-group-text"> 
                            <span class="bi bi-lock-fill"></span> 
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="d-grid gap-2"> 
                                <button type="submit" class="btn btn-primary">
                                    Sign In
                                </button> 
                            </div>
                        </div>
                    </div>
                </form>
            </div> 
        </div>
    </div>
@endsection