@extends('layouts.frontend.master')

@section('title', 'Edit Account')

@section('content')
        <div class="bodyWrapper flex-grow-1">
            <section class="subheader py-5" style="background-image: url('images/account_bg.jpg');">
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
                                        <span>RB</span>
                                        <!-- <img src="{{ asset('assets/frontend/images/dummy.jpg') }}" alt="User Name" class="img-fluid"/> -->
                                    </div>
                                    <div class="user_info_r">
                                        <h4>Rajat Bansal</h4>
                                        <div class="email">rajatatrix@gmail.com</div>
                                    </div>
                                </div>
                                <ul class="account-menu list-unstyled">
                                    <li><a href="my-account"><i class="fa-solid fa-grip"></i> <span>Dashboard</span></a></li>
                                    <li><a href="orders" class="active"><i class="fa-solid fa-bag-shopping"></i> <span>My Orders</span></a></li>
                                    <li><a href="/wishlist"><i class="fa-solid fa-heart"></i> <span>My Wishlist</span></a></li>
                                    <li><a href="edit-address"><i class="fa-solid fa-address-card"></i> <span>Address</span></a></li>
                                    <li><a href="edit-account"><i class="fa-solid fa-user"></i> <span>Account Details</span></a></li>
                                    <li><a href="#"><i class="fa-solid fa-sign-out"></i> <span>Logout</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9 my-2">
                            <div class="account_right_side">
                                <div class="profile_page">
                                    <h2 class="acc_heading pb-3">Edit Profile</h2>
                                    <div class="account_form">
                                        <form action="">
                                            <div class="row">
                                                <div class="form-group col-lg-6 mb-3">
                                                    <label for="fname">First Name</label>
                                                    <input type="text" class="form-control" name="fname" id="fname" placeholder="" value="Rajat">
                                                </div>
                                                <div class="form-group col-lg-6 mb-3">
                                                    <label for="lname">Last Name</label>
                                                    <input type="text" class="form-control" name="lname" id="lname" placeholder="" value="Bansal">
                                                </div>
                                                <div class="form-group col-lg-12 mb-3">
                                                    <label for="displayname">Display Name</label>
                                                    <input type="text" class="form-control" name="displayname" id="displayname" placeholder="" value="Rajat">
                                                </div>
                                                <div class="form-group col-lg-6 mb-3">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="" value="rk891811@gmail.com" readonly="">
                                                </div>
                                                <div class="form-group col-lg-6 mb-3">
                                                    <label for="phonenumber">Phone Number</label>
                                                    <input type="text" class="form-control" name="phonenumber" id="phonenumber" placeholder="" value="+91-98765-43210">
                                                </div>
                                                <div class="form-group col-lg-6 mb-3">
                                                    <label for="dob">DOB</label>
                                                    <input type="date" class="form-control" name="dob" id="dob" placeholder="" value="">
                                                </div>
                                                <div class="form-group col-lg-6 mb-3 pb-2">
                                                    <label for="gender">Gender</label>
                                                    <select name="gender" id="gender" class="form-control">
                                                        <option value="">Select Gender</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>

                                                <legend class="fs-6 col-lg-12 text-uppercase opacity-75">Password Change</legend>
                                                <div class="form-group col-lg-12 mb-3">
                                                    <label for="cpassword">Current Password (Leace blank to leave unchanged)</label>
                                                    <input type="password" class="form-control" name="current_password" id="cpassword" placeholder="" value="">
                                                </div>
                                                <div class="form-group col-lg-12 mb-3">
                                                    <label for="new_password">New Password (Leace blank to leave unchanged)</label>
                                                    <input type="password" class="form-control" name="new_password" id="new_password" placeholder="" value="">
                                                </div>
                                                <div class="form-group col-lg-12 mb-3">
                                                    <label for="confirm_new_password">Confirm New Password</label>
                                                    <input type="password" class="form-control" name="confirm_new_password" id="confirm_new_password" placeholder="" value="">
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="radio" value="Subscribe to our Newsletter" id="newsletter" name="newsletter" required="">
                                                        <label class="form-check-label" for="newsletter">Subscribe to our Newsletter</label>
                                                    </div>
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="radio" value="Unsubscribe from our Newsletter" id="unsub_newsletter" name="newsletter" required="">
                                                        <label class="form-check-label" for="unsub_newsletter">Unsubscribe from our Newsletter</label>
                                                    </div>
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="radio" value="Receive Order Updates" id="receive_order" name="newsletter" required="">
                                                        <label class="form-check-label" for="receive_order">Receive Order Updates</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="submit_btn pt-4">
                                                <button type="submit" class="btn btn-dark py-3 text-uppercase px-5">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
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