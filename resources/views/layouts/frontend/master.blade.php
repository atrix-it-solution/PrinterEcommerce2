 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <title>@yield('title') - Print Help</title>
     <!-- CSS Files -->
     <link rel="stylesheet" href="{{ asset('assets/frontend/css/font-awesome-all.min.css') }}" />
     <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}" />
     <link rel="stylesheet" href="{{ asset('assets/frontend/css/slick.min.css') }}" />
     <link rel="stylesheet" href="{{ asset('assets/frontend/css/slick-theme.min.css') }}" />
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
     <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}">



     <!-- JS (jquery) -->
     <script src="{{ asset('assets/frontend/js/jquery.min.js') }}"></script>

 </head>

 <body>
     <div id="app-routes" 
            data-wishlist-toggle="{{ route('wishlist.toggle') }}"
            data-wishlist-check="{{ route('wishlist.check') }}"
            data-wishlist-data="{{ route('wishlist.data') }}"
            data-cart-add="{{ route('cart.add') }}"
            data-cart-data="{{ route('cart.data') }}"
            style="display: none;">
        </div>
     <main class="min-vh-100 d-flex flex-column">
         {{-- Header --}}
         @include('layouts.frontend.header')

         {{-- Main Content --}}
         @yield('content')

         {{-- Footer --}}
         @include('layouts.frontend.footer')

       
     </main>

       
     <div class="search_sec p-4" id="searchbar">
         <div class="search_sec_inner p-4">
             <div class="search_head">
                 <div class="d-flex justify-content-between align-items-center mb-2">
                     <span>WHAT ARE YOU LOOKING FOR?</span>
                     <a href="javascript:void(0);" id="closeSearch" class="close_icon"><svg class="svg-inline--fa fa-xmark" data-prefix="fas" data-icon="xmark" role="img" viewBox="0 0 384 512" aria-hidden="true" data-fa-i2svg="">
                             <path fill="currentColor" d="M55.1 73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L147.2 256 9.9 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192.5 301.3 329.9 438.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.8 256 375.1 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192.5 210.7 55.1 73.4z"></path>
                         </svg><!-- <i class="fa-solid fa-times"></i> Font Awesome fontawesome.com --></a>
                 </div>
                 <div class="search_bar">
                     <form action="">
                         <div class="form-group position-relative">
                             <input type="text" placeholder="Search Products..." name="search" id="search">
                             <button type="submit" class="searchbtn"><svg class="svg-inline--fa fa-magnifying-glass" data-prefix="fas" data-icon="magnifying-glass" role="img" viewBox="0 0 512 512" aria-hidden="true" data-fa-i2svg="">
                                     <path fill="currentColor" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376C296.3 401.1 253.9 416 208 416 93.1 416 0 322.9 0 208S93.1 0 208 0 416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"></path>
                                 </svg><!-- <i class="fa-solid fa-search"></i> Font Awesome fontawesome.com --></button>
                         </div>
                     </form>
                 </div>
             </div>
             <div class="search_body">
                 <h5 class="subheading">Products</h5>
                 <ul class="product_list list-unstyled">
                     <li>
                         <a href="#" class="sproduct_box d-flex gap-3 gap-md-4">
                             <div class="product_img">
                                 <img src="{{ asset('assets/frontend/images/product1.png') }}" alt="product title" class="img-fluid">
                             </div>
                             <div class="product_content flex-grow-1">
                                 <h4>Alicia Dress</h4>
                                 <div class="price">
                                     <del>$13.00</del>
                                     <ins>$13.00</ins>
                                 </div>
                             </div>
                         </a>
                     </li>
                     <li>
                         <a href="#" class="sproduct_box d-flex gap-3 gap-md-4">
                             <div class="product_img">
                                 <img src="{{ asset('assets/frontend/images/product2.png') }}" alt="product title" class="img-fluid">
                             </div>
                             <div class="product_content flex-grow-1">
                                 <h4>Alicia Dress</h4>
                                 <div class="price">
                                     <del>$13.00</del>
                                     <ins>$13.00</ins>
                                 </div>
                             </div>
                         </a>
                     </li>
                     <li>
                         <a href="#" class="sproduct_box d-flex gap-3 gap-md-4">
                             <div class="product_img">
                                 <img src="{{ asset('assets/frontend/images/product3.png') }}" alt="product title" class="img-fluid">
                             </div>
                             <div class="product_content flex-grow-1">
                                 <h4>Alicia Dress</h4>
                                 <div class="price">
                                     <del>$13.00</del>
                                     <ins>$13.00</ins>
                                 </div>
                             </div>
                         </a>
                     </li>
                     <li>
                         <a href="#" class="sproduct_box d-flex gap-3 gap-md-4">
                             <div class="product_img">
                                 <img src="{{ asset('assets/frontend/images/product4.png') }}" alt="product title" class="img-fluid">
                             </div>
                             <div class="product_content flex-grow-1">
                                 <h4>Alicia Dress</h4>
                                 <div class="price">
                                     <del>$13.00</del>
                                     <ins>$13.00</ins>
                                 </div>
                             </div>
                         </a>
                     </li>
                     <li>
                         <a href="#" class="sproduct_box d-flex gap-3 gap-md-4">
                             <div class="product_img">
                                 <img src="{{ asset('assets/frontend/images/product2.png') }}" alt="product title" class="img-fluid">
                             </div>
                             <div class="product_content flex-grow-1">
                                 <h4>Alicia Dress</h4>
                                 <div class="price">
                                     <del>$13.00</del>
                                     <ins>$13.00</ins>
                                 </div>
                             </div>
                         </a>
                     </li>
                 </ul>

                 <div class="searched_box d-flex align-items-center justify-content-between gap-4 py-3 px-4 bg-light rounded-3">
                     <div>Search for "<span class="text-underline">d</span>"</div>
                     <svg class="svg-inline--fa fa-arrow-right" data-prefix="fas" data-icon="arrow-right" role="img" viewBox="0 0 512 512" aria-hidden="true" data-fa-i2svg="">
                         <path fill="currentColor" d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-105.4 105.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"></path>
                     </svg><!-- <span class="fa-solid fa-arrow-right"></span> Font Awesome fontawesome.com -->
                 </div>
             </div>
         </div>
     </div>


     <div class="modal fade" id="quoteFormModal" tabindex="-1" aria-labelledby="quoteFrom" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="quoteFrom">Get a quote</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="quoteForm" action="{{ route('send.quote') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" id="product_id" name="product_id">
                    <input type="hidden" id="product_name" name="product_name">
                    <input type="hidden" id="product_price" name="product_price">
                    <input type="hidden" id="product_url" name="product_url">
                    
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <div class="form-floating">
                                <input type="text" class="form-control rounded-0" id="name" name="name" placeholder="Full Name" required>
                                <label for="name">Full Name</label>
                                <div class="invalid-feedback">Please enter your full name.</div>
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-floating">
                                <input type="email" class="form-control rounded-0" id="email" name="email" placeholder="Email Address" required>
                                <label for="email">Email address</label>
                                <div class="invalid-feedback">Please enter a valid email address.</div>
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-floating">
                                <input type="tel" class="form-control rounded-0" id="phone" name="phone" placeholder="Enter Phone Number" required>
                                <label for="phone">Phone Number</label>
                                <div class="invalid-feedback">Please enter your phone number.</div>
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-floating">
                                <input type="text" class="form-control rounded-0" id="subject" name="subject" placeholder="Enter Subject" required>
                                <label for="subject">Subject</label>
                                <div class="invalid-feedback">Please enter a subject.</div>
                            </div>
                        </div>
                        <div class="col-md-12 my-3">
                            <div class="form-floating">
                                <textarea class="form-control rounded-0" placeholder="Leave a comment here" id="message" name="message" style="height: 100px" required></textarea>
                                <label for="message">Message</label>
                                <div class="invalid-feedback">Please enter your message.</div>
                            </div>
                        </div>
                        
                        <!-- Success/Error Messages -->
                        <div class="col-12">
                            <div id="formMessages"></div>
                        </div>
                        
                        <div class="submit_btn text-center pt-2">
                            <button type="submit" class="btn btn-dark py-3 px-5 text-uppercase rounded-0" id="submitBtn">
                                Send <i class="fa-solid fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
     <!--JS Files -->
       @yield('scripts')
     <script src="{{ asset('assets/frontend/js/font-awesome-all.min.js') }}"></script>
     <script src="{{ asset('assets/frontend/js/popper.min.js') }}"></script>
     <script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
     <script src="{{ asset('assets/frontend/js/slick.min.js') }}"></script>
     <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/igorlino/elevatezoom-plus/1.1.6/src/jquery.ez-plus.js"></script>
     <script src="{{ asset('assets/frontend/js/custom.js') }}"></script>

    
    <script>

        function updateWishlistCount(count) {
            const wishlistCountElements = document.querySelectorAll('.wishlist-count');
            wishlistCountElements.forEach(element => {
                if (element) {
                    element.textContent = count;
                    if (count > 0) {
                        element.style.display = 'inline';
                    } else {
                        element.style.display = 'none';
                    }
                }
            });
        }
        // Function to fetch wishlist count from server
        function fetchWishlistCount() {
            fetch('{{ route("wishlist.data") }}', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                updateWishlistCount(data.wishlist_count);
            })
            .catch(error => {
                console.error('Error loading wishlist count:', error);
            });
        }

        // Load both counts on page load
        document.addEventListener('DOMContentLoaded', function() {
            fetchWishlistCount();
        });

        // Make functions globally available
       
        window.updateWishlistCount = updateWishlistCount;
        window.fetchWishlistCount = fetchWishlistCount;
    </script>


 </body>

 </html>