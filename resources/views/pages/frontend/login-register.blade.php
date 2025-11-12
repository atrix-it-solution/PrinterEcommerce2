@extends('layouts.frontend.master')

@section('title', 'Login & Register')

@section('content')
<div class="bodyWrapper flex-grow-1 login-register-page">
    <!-- ========== Start Page heading ========== -->
    <section class="subheader py-5" style="background-image: url('/assets/frontend/images/account_bg.jpg');">
        <div class="container py-lg-5">
            <div class="row">
                <div class="col-md-6 text-white">
                    <h1 class="text-dark">Login/Register</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- ========== End Page heading ========== -->

    <!-- ========== Start Login Register ========== -->
    <section class="login-register-area section-space my-5">
        <div class="container">
            <div class="row">
                <!-- Login Form -->
                <div class="col-md-6 login-register-border">
                    <div class="login-register-content w-75 mx-auto py-5">
                        <div class="login-register-title mb-30">
                            <h2>Login</h2>
                            <p>Welcome back! Please enter your username and password to login.</p>
                        </div>

                        <!-- Login Specific Errors -->
                        @if($errors->has('login_email') || $errors->has('login_password'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @if($errors->has('email'))
                                        <li>{{ $errors->first('email') }}</li>
                                    @endif
                                    @if($errors->has('password'))
                                        <li>{{ $errors->first('password') }}</li>
                                    @endif
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="cusform">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 my-2">
                                        <div class="form-floating">
                                            <input type="email" class="form-control rounded-0 @error('email', 'login') is-invalid @enderror" 
                                                   id="login_email" name="email" placeholder="Email Address" 
                                                   value="{{ old('email') }}" required autocomplete="email">
                                            <label for="login_email">Email address</label>
                                            @error('email', 'login')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 my-2">
                                        <div class="form-floating">
                                            <input type="password" class="form-control rounded-0 @error('password', 'login') is-invalid @enderror" 
                                                   id="login_password" name="password" placeholder="Enter Password" 
                                                   required autocomplete="current-password">
                                            <label for="login_password">Password</label>
                                            @error('password', 'login')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 my-2 d-flex justify-content-between">
                                        <div class="remember-me-btn">
                                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label for="remember">Remember me</label>
                                        </div>
                                        <a href="/forgot-password" class="text-decoration-underline">Forgot your password?</a>
                                    </div>
                                    <div class="submit_btn pt-3">
                                        <button type="submit" class="btn btn-dark py-3 px-5 text-uppercase rounded-0">
                                            Login <i class="fa-solid fa-arrow-right ms-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Register Form -->
                <div class="col-md-6">
                    <div class="login-register-content w-75 mx-auto py-5">
                        <div class="login-register-title mb-30">
                            <h2>Register</h2>
                            <p>Create new account today to reap the benefits of a personalized shopping experience.</p>
                        </div>

                        <!-- Register Specific Errors -->
                        @if($errors->has('name') || $errors->has('register_email') || $errors->has('phone') || $errors->has('password'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @if($errors->has('name'))
                                        <li>{{ $errors->first('name') }}</li>
                                    @endif
                                    @if($errors->has('email'))
                                        <li>{{ $errors->first('email') }}</li>
                                    @endif
                                    @if($errors->has('phone'))
                                        <li>{{ $errors->first('phone') }}</li>
                                    @endif
                                    @if($errors->has('password'))
                                        <li>{{ $errors->first('password') }}</li>
                                    @endif
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="cusform">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 my-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control rounded-0 @error('name', 'register') is-invalid @enderror" 
                                                   id="register_name" name="name" placeholder="Full Name" 
                                                   value="{{ old('name') }}" required autocomplete="name">
                                            <label for="register_name">Full Name</label>
                                            @error('name', 'register')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 my-2">
                                        <div class="form-floating">
                                            <input type="email" class="form-control rounded-0 @error('email', 'register') is-invalid @enderror" 
                                                   id="register_email" name="email" placeholder="Email Address" 
                                                   value="{{ old('email') }}" required autocomplete="email">
                                            <label for="register_email">Email address</label>
                                            @error('email', 'register')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 my-2">
                                        <div class="form-floating">
                                            <input type="tel" class="form-control rounded-0 @error('phone', 'register') is-invalid @enderror" 
                                                   id="register_phone" name="phone" placeholder="Enter Phone Number" 
                                                   value="{{ old('phone') }}" >
                                            <label for="register_phone">Phone Number</label>
                                            @error('phone', 'register')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 my-2">
                                        <div class="form-floating">
                                            <input type="password" class="form-control rounded-0 @error('password', 'register') is-invalid @enderror" 
                                                   id="register_password" name="password" placeholder="Password" 
                                                   required autocomplete="new-password">
                                            <label for="register_password">Password</label>
                                            @error('password', 'register')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 my-2">
                                        <div class="form-floating">
                                            <input type="password" class="form-control rounded-0 @error('password_confirmation', 'register') is-invalid @enderror" 
                                                   id="register_password_confirmation" name="password_confirmation" 
                                                   placeholder="Confirm Password" required autocomplete="new-password">
                                            <label for="register_password_confirmation">Confirm Password</label>
                                            @error('password_confirmation', 'register')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 my-2">
                                        <p>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our <a class="text-primary" href="/privacy-policy">privacy policy.</a></p>
                                    </div>
                                    <div class="submit_btn pt-3">
                                        <button type="submit" class="btn btn-dark py-3 px-5 text-uppercase rounded-0">
                                            Register <i class="fa-solid fa-arrow-right ms-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========== End Login Register ========== -->
</div>

<!-- Display Success Messages -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@endsection