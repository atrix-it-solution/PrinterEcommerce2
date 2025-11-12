@extends('layouts.frontend.master')

@section('title', 'Account')

@section('content')
        <div class="bodyWrapper flex-grow-1">
            <section class="subheader py-5" style="background-image: url('/assets/frontend/images/account_bg.jpg')"> 
                <div class="container py-lg-5">
                    <div class="row">
                        <div class="col-md-6 text-white">
                            <h1 class="text-dark">My Account</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="myaccount_sec py-5">
                <div class="container">
                    <div class="row gx-lg-5">
                        <div class="col-lg-3 my-2">
                            <div class="account_sidebar">
                                <div class="user_info mb-3 d-flex gap-2">
                                    <div class="user_img">
                                         @php
                                            // Get initials from name
                                            $names = explode(' ', $user->name);
                                            $initials = '';
                                            if(count($names) >= 2) {
                                                $initials = strtoupper(substr($names[0], 0, 1) . substr($names[count($names)-1], 0, 1));
                                            } else {
                                                $initials = strtoupper(substr($user->name, 0, 2));
                                            }
                                        @endphp
                                        <span>{{ $initials }}</span>
                                        <!-- <img src="{{ asset('assets/frontend/images/dummy.jpg') }}" alt="User Name" class="img-fluid"/> -->
                                    </div>
                                    <div class="user_info_r">
                                        <h4>{{ ucwords(strtolower($user->name)) }}</h4>
                                        <div class="email">{{ $user->email }}</div>
                                    </div>
                                </div>
                                <ul class="account-menu list-unstyled">
                                    <li><a href="/my-account" class="active"><i class="fa-solid fa-grip"></i> <span>Dashboard</span></a></li>
                                    <li><a href="/orders"><i class="fa-solid fa-bag-shopping"></i> <span>My Orders</span></a></li>
                                    <li><a href="/wishlist"><i class="fa-solid fa-heart"></i> <span>My Wishlist</span></a></li>
                                    <li><a href="/edit-address"><i class="fa-solid fa-address-card"></i> <span>Address</span></a></li>
                                    <li><a href="/edit-account"><i class="fa-solid fa-user"></i> <span>Account Details</span></a></li>
                                    
                                    <li><a href="#"><i class="fa-solid fa-sign-out"></i> 
                                        <span>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="dropdown-item">Logout</button>
                                            </form>
                                        </span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9 my-2">
                            <div class="account_right_side">
                                <div class="dashboard_page">
                                    <p>Hello <strong class="username">{{ $user->name }}</strong> (not <strong class="username">{{ $user->name }}</strong>? <a href="#" class="text-decoration-underline">Log out</a>)</p>
                                    <p>From your account dashboard you can view your <a href="#" class="text-decoration-underline">recent orders</a>, manage your <a href="#" class="text-decoration-underline">shipping and billing addresses</a>, and <a href="#" class="text-decoration-underline">edit your password and account details.</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            


            <hr style="opacity: .1;">

            <section class="features_sec py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-6 col-xl-3 my-3">
                            <div class="feature_box">
                                <div class="feature_icon">
                                    <img src="{{ asset('assets/frontend/images/sicon1.svg') }}" alt="Complimentary Shipping" class="img-fluid" />
                                </div>
                                <h4>Complimentary Shipping</h4>
                                <p>Free worldwide shipping and returns - customs and duties taxes included.</p>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 my-3">
                            <div class="feature_box">
                                <div class="feature_icon">
                                    <img src="{{ asset('assets/frontend/images/sicon2.svg') }}" alt="Customer service" class="img-fluid" />
                                </div>
                                <h4>Customer service</h4>
                                <p>We are available from Monday-Friday to answer your questions.</p>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 my-3">
                            <div class="feature_box">
                                <div class="feature_icon">
                                    <img src="{{ asset('assets/frontend/images/sicon3.svg') }}" alt="Secure payment" class="img-fluid" />
                                </div>
                                <h4>Secure payment</h4>
                                <p>Your payment information is processed securely.</p>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 my-3">
                            <div class="feature_box">
                                <div class="feature_icon">
                                    <img src="{{ asset('assets/frontend/images/sicon4.svg') }}" alt="Contact us" class="img-fluid" />
                                </div>
                                <h4>Contact us</h4>
                                <p>Need to contact us? Send us an e-mail at support@printhelp.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
@endsection 