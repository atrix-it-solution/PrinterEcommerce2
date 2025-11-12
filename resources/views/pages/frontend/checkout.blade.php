@extends('layouts.frontend.master')

@section('title', 'Checkout')

@section('content')
        <div class="bodyWrapper flex-grow-1">
            <section class="subheader py-5" style="background-image: url('images/checkout_bg.jpg');">
                <div class="container py-lg-5">
                    <div class="row">
                        <div class="col-md-6 text-white">
                            <h1>Checkout</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="couper_sec pt-5">
                <div class="container pt-lg-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="accordion" id="coupon_code">
                                <div class="accordion-item border-0">
                                    <div class="accordion-header text-center">
                                        Have a coupon? <span class="collapsed" data-bs-toggle="collapse" data-bs-target="#couponCode" aria-expanded="false" aria-controls="couponCode"><u>Enter your code</u></span>
                                    </div>
                                    <div id="couponCode" class="accordion-collapse collapse" data-bs-parent="#coupon_code">
                                        <div class="accordion-body">
                                            <form action="">
                                                <div class="form-group pt-2">
                                                    <input type="text" placeholder="Coupon Code" class="form-control mb-3" />
                                                    <button type="submit" class="btn btn-dark w-100"> Apply Coupon</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="checkout_sec py-5">
                <div class="container py-lg-4">
                    <div class="notices-wrapper"></div>
                    <div class="row gx-lg-5">
                        <div class="col-lg-7 my-3">
                            <form action="" class="cart-form">
                                <div class="checkout_form_box">
                                    <h2 class="checkout_heading">Billing Details</h2>
                                    <div class="row">
                                        <div class="col-lg-6 my-2">
                                            <div class="form-group">
                                                <label for="fname">First Name <span class="required">*</span></label>
                                                <input type="text" name="fname" id="fname"  value="" class="form-control" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 my-2">
                                            <div class="form-group">
                                                <label for="lname">Last Name <span class="required">*</span></label>
                                                <input type="text" name="lname" id="lname"  value="" class="form-control" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 my-2">
                                            <div class="form-group">
                                                <label for="companyname">Company Name (Optional)</label>
                                                <input type="text" name="companyname" id="companyname"  value="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 my-2">
                                            <div class="form-group">
                                                <label for="country">Country / Region <span class="required">*</span></label>
                                                <select class="form-control" name="country" id="country" required>
                                                    <option value="">India</option>
                                                    <option value="">US</option>
                                                    <option value="">UK</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 my-2">
                                            <div class="form-group">
                                                <label for="stretaddress">Street address</label>
                                                <input type="text" name="stretaddress" id="stretaddress" placeholder="House number and street name"  value="" class="form-control mb-2">
                                                <input type="text" name="apartment" id="apartment" placeholder="Apartment, suite, unit, etc. (optional)"  value="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 my-2">
                                            <div class="form-group">
                                                <label for="State">State <span class="required">*</span></label>
                                                <select class="form-control" name="State" id="State" required>
                                                    <option value="">Punjab</option>
                                                    <option value="">Chandigarh</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 my-2">
                                            <div class="form-group">
                                                <label for="city">Town / City <span class="required">*</span></label>
                                                <input type="text" name="city" id="city"  value="" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 my-2">
                                            <div class="form-group">
                                                <label for="zipcode">ZIP Code <span class="required">*</span></label>
                                                <input type="text" name="zipcode" id="zipcode"  value="" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 my-2">
                                            <div class="form-group">
                                                <label for="phone">Phone Number <span class="required">*</span></label>
                                                <input type="tel" name="phone" id="phone"  value="" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 my-2">
                                            <div class="form-group">
                                                <label for="email">Email Address <span class="required">*</span></label>
                                                <input type="email" name="email" id="email"  value="" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 my-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="createAccount" name="createAccount">
                                                <label class="form-check-label" for="createAccount">Create an account?</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="shipAddress" name="shipAddress">
                                                <label class="form-check-label" for="shipAddress">Ship to a different address?</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="shipping_fields collapse" id="shipping_fields">
                                        <div class="row">
                                            <div class="col-lg-6 my-2">
                                                <div class="form-group">
                                                    <label for="Shipping_fname">First Name <span class="required">*</span></label>
                                                    <input type="text" name="Shipping_fname" id="fname"  value="" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 my-2">
                                                <div class="form-group">
                                                    <label for="Shipping_lname">Last Name <span class="required">*</span></label>
                                                    <input type="text" name="Shipping_lname" id="lname"  value="" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-12 my-2">
                                                <div class="form-group">
                                                    <label for="Shipping_companyname">Company Name (Optional)</label>
                                                    <input type="text" name="Shipping_companyname" id="companyname"  value="" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 my-2">
                                                <div class="form-group">
                                                    <label for="Shipping_country">Country / Region <span class="required">*</span></label>
                                                    <select class="form-control" name="Shipping_country" id="country" required>
                                                        <option value="">India</option>
                                                        <option value="">US</option>
                                                        <option value="">UK</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 my-2">
                                                <div class="form-group">
                                                    <label for="Shipping_stretaddress">Street address</label>
                                                    <input type="text" name="Shipping_stretaddress" id="stretaddress" placeholder="House number and street name"  value="" class="form-control mb-2">
                                                    <input type="text" name="Shipping_apartment" id="apartment" placeholder="Apartment, suite, unit, etc. (optional)"  value="" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 my-2">
                                                <div class="form-group">
                                                    <label for="Shipping_State">State <span class="required">*</span></label>
                                                    <select class="form-control" name="Shipping_State" id="State" required>
                                                        <option value="">Punjab</option>
                                                        <option value="">Chandigarh</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 my-2">
                                                <div class="form-group">
                                                    <label for="Shipping_city">Town / City <span class="required">*</span></label>
                                                    <input type="text" name="Shipping_city" id="city"  value="" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 my-2">
                                                <div class="form-group">
                                                    <label for="Shipping_zipcode">ZIP Code <span class="required">*</span></label>
                                                    <input type="text" name="Shipping_zipcode" id="zipcode"  value="" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 my-2">
                                                <div class="form-group">
                                                    <label for="Shipping_phone">Phone Number <span class="required">*</span></label>
                                                    <input type="tel" name="Shipping_phone" id="phone"  value="" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 my-2">
                                                <div class="form-group">
                                                    <label for="Shipping_email">Email Address <span class="required">*</span></label>
                                                    <input type="email" name="Shipping_email" id="email"  value="" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-5 my-3">
                            <div class="order_review">
                                <h2 class="checkout_heading">Your order</h2>
                                <div class="product_table">
                                    <table class="shop_table">
                                        <thead class="hidden-xs">
                                            <tr>
                                                <th class="ps-0">Product</th>
                                                <th class="text-end pe-0">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="product-thumbnail" data-title="Product">
                                                    <div class="product-dtl">
                                                        <h4>HP DeskJet 4155e All-in-One Wireless Color Inkjet Printer <span class="total-product">x 1 </span></h4>
                                                        <div class="product_price">
                                                            <span class="amount">
                                                                <del aria-hidden="true">
                                                                    <span class="price-amount amount"><bdi><span class="price-currencySymbol">$</span>109.99</bdi></span>
                                                                </del>
                                                                <ins aria-hidden="true">
                                                                    <span class="price-amount amount"><bdi><span class="price-currencySymbol">$</span>69.99</bdi></span>
                                                                </ins>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="product_price pe-0 text-end" data-title="Total">
                                                    <span class="amount">
                                                        <bdi><span class="price-currencySymbol">$</span>69.99</bdi>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="product-thumbnail" data-title="Product">
                                                    <div class="product-dtl">
                                                        <h4>HP DeskJet 4155e All-in-One Wireless Color Inkjet Printer <span class="total-product">x 1 </span></h4>
                                                        <div class="product_price">
                                                            <span class="amount">
                                                                <del aria-hidden="true">
                                                                    <span class="price-amount amount"><bdi><span class="price-currencySymbol">$</span>109.99</bdi></span>
                                                                </del>
                                                                <ins aria-hidden="true">
                                                                    <span class="price-amount amount"><bdi><span class="price-currencySymbol">$</span>69.99</bdi></span>
                                                                </ins>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="product_price pe-0 text-end" data-title="Total">
                                                    <span class="amount">
                                                        <bdi><span class="price-currencySymbol">$</span>69.99</bdi>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="product-thumbnail" data-title="Product">
                                                    <div class="product-dtl">
                                                        <h4>HP DeskJet 4155e All-in-One Wireless Color Inkjet Printer <span class="total-product">x 1 </span></h4>
                                                        <div class="product_price">
                                                            <span class="amount">
                                                                <bdi><span class="price-currencySymbol">$</span>579.00</bdi>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="product_price pe-0 text-end" data-title="Total">
                                                    <span class="amount">
                                                        <bdi><span class="price-currencySymbol">$</span>579.00</bdi>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="ps-0">Subtotal</th>
                                                <td class="pe-0 text-end">$185.00</td>
                                            </tr>
                                            <tr>
                                                <th class="ps-0">Shipping</th>
                                                <td class="pe-0 text-end">
                                                    Free Shipping
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="ps-0">Total</th>
                                                <td class="pe-0 text-end">$185.00</td>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <div class="payment_box">
                                        <ul class="list-unstyled">
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="Direct bank transfer" id="backTransfer" name="paymentMethod" required />
                                                    <label class="form-check-label" for="backTransfer">Direct bank transfer</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="Check payments" id="CheckPayments" name="paymentMethod" required />
                                                    <label class="form-check-label" for="CheckPayments">Check payments</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="Cash on delivery" id="Cashdelivery" name="paymentMethod" required />
                                                    <label class="form-check-label" for="Cashdelivery">Cash on delivery</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="policy_text">
                                        <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="#">privacy policy</a>.</p>
                                    </div>

                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="checkbox" value="" id="agreeTerms" name="agreeTerms" required />
                                        <label class="form-check-label" for="agreeTerms">I have read and agree to the website <a href="#">terms and conditions *</a></label>
                                    </div>

                                    <button class="btn btn-dark w-100 placebtn" type="submit">Place Order</button>

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