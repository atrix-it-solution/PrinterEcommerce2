@extends('layouts.frontend.master')

@section('title', 'Contact Us')

@section('content')
        <div class="bodyWrapper flex-grow-1 login-register-page">
            <!-- ========== Start Page heading ========== -->
            <section class="subheader py-5" style="background-image: url('/assets/frontend/images/account_bg.jpg');">
                <div class="container py-lg-5">
                    <div class="row">
                        <div class="col-md-6 text-white">
                            <h1 class="text-dark">Forgot your password?</h1>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ========== End Page heading ========== -->

            <!-- ========== Start Forgot Password ========== -->
            <section class="login-register-area section-space my-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-3 ">
                            <div class="login-register-content w-75 mx-auto py-5">
                                <div class="login-register-title mb-30">
                                    <h2>Reset Password</h2>
                                    <p>Welcome back! Please enter your email address to reset your password.</p>
                                </div>
                                <div class="cusform">
                                    <form action="">
                                        <div class="row">
                                            
                                            <div class="col-md-12 my-2">
                                                <div class="form-floating">
                                                    <input type="email" class="form-control rounded-0" id="email" placeholder="Email Address">
                                                    <label for="email">Email address</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 my-2 d-flex justify-content-between">
                                                    <a href="/login-register" class="text-decoration-underline">Login/register</a>
                                            </div>
                                            <div class="submit_btn pt-3">
                                                <button type="submit" class="btn btn-dark py-3 px-5 text-uppercase rounded-0">Send<i class="fa-solid fa-arrow-right ms-2"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </section>
            <!-- ========== End Forgot Password ========== -->
        </div>
        @endsection