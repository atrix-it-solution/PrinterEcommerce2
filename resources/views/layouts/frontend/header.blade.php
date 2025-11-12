        <header>
            <div class="topbar bg-theme text-white py-2">
                <div class="container-fluid px-lg-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 col-6">
                            <ul class="topbar_info_list d-flex align-items-center justify-content-center justify-content-lg-start gap-4 mb-0 list-unstyled">
                                <li><a href="mailto:info@printhelp.com"><i class="fa-solid fa-envelope"></i> info@printhelp.com</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <div class="offer_slider common_slider">
                                <div class="offer_slide text-center">
                                    <p class="mb-0">Winter sale discount off 30%! <a href="#">Shop now</a></p>
                                </div>
                                <div class="offer_slide text-center">
                                    <p class="mb-0">Winter sale discount off 10%! <a href="#">Shop now</a></p>
                                </div>
                                <div class="offer_slide text-center">
                                    <p class="mb-0">Winter sale discount off 50%! <a href="#">Shop now</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <ul class="topbar_info_list d-flex align-items-center justify-content-center justify-content-lg-end gap-4 mb-0 list-unstyled">
                                <li><a href="tel:+919410109369"><i class="fa-solid fa-phone"></i> +91 12345-67890</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-expand-xl">
                <div class="container-fluid px-lg-4">
                    <div class="menubtn d-flex align-items-center d-xl-none">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 200 200">
                                <g stroke-width="6.5" stroke-linecap="round">
                                    <path d="M72 82.286h28.75" fill="#009100" fill-rule="evenodd" stroke="var(--theme)" />
                                    <path d="M100.75 103.714l72.482-.143c.043 39.398-32.284 71.434-72.16 71.434-39.878 0-72.204-32.036-72.204-71.554" fill="none" stroke="var(--theme)" />
                                    <path d="M72 125.143h28.75" fill="#009100" fill-rule="evenodd" stroke="var(--theme)" />
                                    <path d="M100.75 103.714l-71.908-.143c.026-39.638 32.352-71.674 72.23-71.674 39.876 0 72.203 32.036 72.203 71.554" fill="none" stroke="var(--theme)" />
                                    <path d="M100.75 82.286h28.75" fill="#009100" fill-rule="evenodd" stroke="var(--theme)" />
                                    <path d="M100.75 125.143h28.75" fill="#009100" fill-rule="evenodd" stroke="var(--theme)" />
                                </g>
                            </svg>
                        </button>
                        <div class="d-xl-none pt-1"><a href="javascript:void(0);" class="search-trigger" id="search" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Search"><i class="fa-solid fa-search"></i></a></div>
                    </div>
                    <a class="navbar-brand" href="/">
                        <img src="{{ asset('assets/frontend/images/vsipl-logo.png') }}" alt="PrintHelp Logo" class="img-fluid" />
                    </a>
                    <div class="d-flex align-items-center justify-content-end justify-content-xl-between flex-xl-grow-1">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <a class="navbar-brand d-block pt-0 d-xl-none text-center me-0 mb-3" href="/">
                                <img src="{{ asset('assets/frontend/images/vsipl-logo.png') }}" alt="PrintHelp Logo" class="img-fluid" />
                            </a>

                            <ul class="navbar-nav me-auto ms-auto mb-2 mb-lg-0 ps-xl-3 ps-xxl-4">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="/">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="/about">About Us</a>
                                </li>
                                <li class="nav-item ">
                                    <a href="/shop" class="nav-link {{ request()->is('shop') ? 'active' : '' }}">Shop</a>
                                </li>
                                @foreach($categories as $category)
                                <li class="nav-item">
                                    <a href="{{ route('category.show', $category->slug) }}"
                                        class="nav-link {{ request()->is('category/' . $category->slug) ? 'active' : '' }}">
                                        {{ $category->title }}
                                    </a>
                                </li>
                                @endforeach
                                <li class="nav-item">
                                    <a href="/contact" class="nav-link {{ request()->is('contact') ? 'active' : '' }}">Contact Us</a>
                                </li>
                            </ul>
                            <div class="mobile_info d-xl-none">
                                <ul class="navbar-nav pt-4">
                                    <li><a href="tel:+919410109369"><i class="text-theme me-2 fa-solid fa-phone"></i> +91 94101-09369</a></li>
                                    <li><a href="mailto:info@printhelp.com"><i class="text-theme me-2 fa-regular fa-envelope"></i> info@printhelp.com</a></li>
                                    <li><a href="javascript:void(0);"><i class="text-theme me-2 fa-solid fa-map-marker-alt"></i> Saharanpur, UP, India</a></li>
                                </ul>
                            </div>
                        </div>
                        <ul class="navbar-nav flex-row d-flex gap-2 gap-xxl-4 header_right_area">
                            <li class="d-none d-xl-block"><a href="javascript:void(0);" class="search-trigger" id="search" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Search"><i class="fa-solid fa-search"></i></a></li>
                            @auth
                            <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Logout">
                                <form method="POST" action="{{ route('logout') }}"  class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-link text-dark p-0 border-0 bg-transparent"><i class="fa-solid fa-right-from-bracket"></i></button>
                                </form>
                            </li>
                            @else
                            <li>
                                <a href="{{ route('login.register') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Login/Register">
                                    <i class="fa-regular fa-user"></i>
                                </a>
                            </li>
                            @endauth

                            <li class="me-1">
                                <a href="{{ route('wishlist.view') }}" class="position-relative header-wishlist" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" data-bs-title="Wishlist">
                                    <i class="fa-regular fa-heart"></i> 
                                    <span class="count wishlist-count badge  position-absolute top-0 start-100 translate-middle" >
                                        0
                                    </span>
                                </a>
                            </li>

                           
                        </ul>
                    </div>
                </div>
            </nav>
        </header>