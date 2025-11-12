@extends('layouts.frontend.master')

@section('title', 'Shop')

@section('content')
        <div class="bodyWrapper flex-grow-1">
            <section class="shop_header py-5">
                <div class="container text-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center mb-1">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shop</li>
                        </ol>
                    </nav>
                    <h1 class="mb-0 text-white">Our Products</h1>
                </div>
            </section>
            
            <section class="shop_sec py-5">
                <div class="container py-lg-3">
                    <div class="row gx-lg-5">
                        <div class="col-lg-3">
                            <div class="filter pb-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="fw-normal">Filter</h5>
                                    <a href="javascript:void(0);" class="clearAll small text-decoration-underline">Clear all</a>
                                </div>

                                <div class="selected_items pt-1">
                                    <span class="badge fw-normal d-flex align-items-center rounded-pill text">In Stock <a href="javascript:void(0);" class="reset_filter"><i class="fa-solid fa-times"></i></a></span>
                                    <span class="badge fw-normal d-flex align-items-center rounded-pill text">&#8377;0.00 - &#8377;600 <a href="javascript:void(0);" class="reset_filter"><i class="fa-solid fa-times"></i></a></span>
                                    <span class="badge fw-normal d-flex align-items-center rounded-pill text">On Sale <a href="javascript:void(0);" class="reset_filter"><i class="fa-solid fa-times"></i></a></span>
                                </div>
                            </div>

                            <div class="filter_inner">
                                <div class="filter_box">
                                    <h6 class="filter_name">Categories</h6>
                                    <ul class="cuschecbox filter_list">
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" id="cat1" name="category" value="Deskjet Printers" />
                                                <label for="cat1">Deskjet Printers <span>(06)</span></label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" id="cat2" name="category" value="Envy Printers"  />
                                                <label for="cat2">Envy Printers <span>(10)</span></label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" id="cat3" name="category" value="Laserjet Printers" />
                                                <label for="cat3">Laserjet Printers <span>(12)</span></label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" id="cat4" name="category" value="Officejet Printers" />
                                                <label for="cat4">Officejet Printers <span>(01)</span></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="filter_box">
                                    <h6 class="filter_name">Availability</h6>
                                    <ul class="cuschecbox filter_list">
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" id="instock" name="availability" value="In stock" />
                                                <label for="instock">On sale <span>(26)</span></label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" id="outstock" name="availability" value="Out of stock" />
                                                <label for="outstock">In stock <span>(35)</span></label>
                                        </li>
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" id="outstock" name="availability" value="Out of stock" />
                                                <label for="outstock">Out of stock <span>(06)</span></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                 <div class="filter_box">
                                    <h6 class="filter_name">Price</h6>
                                    <div class="price_filter d-flex align-items-end">
                                        <div class="form">
                                            <div class="small">From</div>
                                            <div class="input_box position-relative">
                                                <input type="number" name="from" class="form-control" id="from" min="0" value="0" placeholder="0" />
                                                <span class="position-absolute">&#8377;</span>
                                            </div>
                                        </div>
                                        <span class="mx-2 px-1">-</span>
                                        <div class="to">
                                            <div class="small">To</div>
                                            <div class="input_box position-relative">
                                                <input type="number" name="to" class="form-control" id="to" placeholder="10000" value="10000"/>
                                                <span class="position-absolute">&#8377;</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col-lg-9">
                            <h5 class="cat_name fw-normal pb-3">Products</h5>


                            <div class="product_filter d-flex justify-content-between align-items-center gap-3 pb-3 border-bottom mb-3">
                                <span class="total_products">29 Products</span>
                                <div class="sorting">
                                    <form action="">
                                        <div class="form-group d-flex align-items-center">
                                            <label class="text-nowrap pe-1" for="">Sort By:</label>
                                            <select name="" id="" class="form-control opacity-75">
                                                <option value="">Best selling</option>
                                                <option value="">Alphabetically, A-Z</option>
                                                <option value="">Alphabetically, Z-A</option>
                                                <option value="">Price, low to high</option>
                                                <option value="">Price, high to low</option>
                                                <option value="">Date, new to old</option>
                                                <option value="">Date, old to new</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="product_list_sec">
                                <ul class="productlist column-3">
                                    <li>
                                        <div class="product_box">
                                            <a href="#" class="product_img">
                                                <img src="{{ asset('assets/frontend/images/product6.png') }}" alt="Product Name" class="img-fluid" />
                                                <img src="{{ asset('assets/frontend/images/product6.png') }}" alt="Product Name" class="img-fluid hover_img" />
                                                <div class="cart_btn">
                                                    <button class="cusbtn cartbtn">Add to cart</button>
                                                </div>
                                            </a>
                                            <div class="product_meta">
                                                <div class="discount_percent">-50%</div>
                                                <div class="wishlist">
                                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Add to Wishlist"><i class="fa-regular fa-heart"></i></span>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h4><a href="#">(Renewed) HP DeskJet 4155e All-in-One Wireless Color Inkjet Printer</a></h4>
                                                <div class="price">
                                                    <del>$80.00</del>
                                                    <ins>$39.00</ins>
                                                </div>
                                                <div class="rating">
                                                    <span class="fa-solid fa-star"></span>
                                                    <span class="fa-solid fa-star"></span>
                                                    <span class="fa-solid fa-star"></span>
                                                    <span class="fa-solid fa-star"></span>
                                                    <span class="fa-regular fa-star"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="product_box">
                                            <a href="#" class="product_img">
                                                <img src="{{ asset('assets/frontend/images/product1.png') }}" alt="Product Name" class="img-fluid" />
                                                <img src="{{ asset('assets/frontend/images/product1.png') }}" alt="Product Name" class="img-fluid hover_img" />
                                                <div class="cart_btn">
                                                    <button class="cusbtn cartbtn">Add to cart</button>
                                                </div>
                                            </a>
                                            <div class="product_meta">
                                                <div class="discount_percent">-50%</div>
                                                <div class="wishlist">
                                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Add to Wishlist"><i class="fa-regular fa-heart"></i></span>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h4><a href="#">HP OfficeJet Pro 9125e All-in-One Printer</a></h4>
                                                <div class="price">
                                                    <del>$99.00</del>
                                                    <ins>$89.00</ins>
                                                </div>
                                                <div class="rating">
                                                    <span class="fa-solid fa-star"></span>
                                                    <span class="fa-solid fa-star"></span>
                                                    <span class="fa-solid fa-star"></span>
                                                    <span class="fa-solid fa-star"></span>
                                                    <span class="fa-regular fa-star"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="product_box">
                                            <a href="#" class="product_img">
                                                <img src="{{ asset('assets/frontend/images/product4.png') }}" alt="Product Name" class="img-fluid" />
                                                <img src="{{ asset('assets/frontend/images/product5.png') }}" alt="Product Name" class="img-fluid hover_img" />
                                                <div class="cart_btn">
                                                    <button class="cusbtn cartbtn">Add to cart</button>
                                                </div>
                                            </a>
                                            <div class="product_meta">
                                                <div class="discount_percent">-50%</div>
                                                <div class="wishlist">
                                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Add to Wishlist"><i class="fa-regular fa-heart"></i></span>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h4><a href="#">HP Color LaserJet Pro MFP 3301fdw Wireless Printer</a></h4>
                                                <div class="price">
                                                    <del>$70.00</del>
                                                    <ins>$49.00</ins>
                                                </div>
                                                <div class="rating">
                                                    <span class="fa-solid fa-star"></span>
                                                    <span class="fa-solid fa-star"></span>
                                                    <span class="fa-solid fa-star"></span>
                                                    <span class="fa-solid fa-star"></span>
                                                    <span class="fa-regular fa-star"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="product_box">
                                            <a href="#" class="product_img">
                                                <img src="{{ asset('assets/frontend/images/product2.png') }}" alt="Product Name" class="img-fluid" />
                                                <img src="{{ asset('assets/frontend/images/product2.png') }}" alt="Product Name" class="img-fluid hover_img" />
                                                <div class="cart_btn">
                                                    <button class="cusbtn cartbtn">Add to cart</button>
                                                </div>
                                            </a>
                                            <div class="product_meta">
                                                <div class="discount_percent">-50%</div>
                                                <div class="wishlist">
                                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Add to Wishlist"><i class="fa-regular fa-heart"></i></span>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h4><a href="#">HP OfficeJet Pro 8135e Wireless All-in-One Printer</a></h4>
                                                <div class="price">
                                                    <del>$149.00</del>
                                                    <ins>$129.00</ins>
                                                </div>
                                                <div class="rating">
                                                    <span class="fa-solid fa-star"></span>
                                                    <span class="fa-solid fa-star"></span>
                                                    <span class="fa-solid fa-star"></span>
                                                    <span class="fa-solid fa-star"></span>
                                                    <span class="fa-regular fa-star"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="product_box">
                                            <a href="#" class="product_img">
                                                <img src="{{ asset('assets/frontend/images/product5.png') }}" alt="Product Name" class="img-fluid" />
                                                <img src="{{ asset('assets/frontend/images/product5.png') }}" alt="Product Name" class="img-fluid hover_img" />
                                                <div class="cart_btn">
                                                    <button class="cusbtn cartbtn">Add to cart</button>
                                                </div>
                                            </a>
                                            <div class="product_meta">
                                                <div class="discount_percent">-50%</div>
                                                <div class="wishlist">
                                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Go to Wishlist"><i class="fa-solid fa-heart"></i></span>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h4><a href="#">HP LaserJet Pro MFP 3101sdw Printer</a></h4>
                                                <div class="price">
                                                    <del>$77.00</del>
                                                    <ins>$47.00</ins>
                                                </div>
                                                <div class="rating">
                                                    <span class="fa-solid fa-star"></span>
                                                    <span class="fa-solid fa-star"></span>
                                                    <span class="fa-solid fa-star"></span>
                                                    <span class="fa-solid fa-star"></span>
                                                    <span class="fa-regular fa-star"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="product_box">
                                            <a href="#" class="product_img">
                                                <img src="{{ asset('assets/frontend/images/product3.png') }}" alt="Product Name" class="img-fluid" />
                                                <img src="{{ asset('assets/frontend/images/product3.png') }}" alt="Product Name" class="img-fluid hover_img" />
                                                <div class="cart_btn">
                                                    <button class="cusbtn cartbtn">Add to cart</button>
                                                </div>
                                            </a>
                                            <div class="product_meta">
                                                <div class="discount_percent">-50%</div>
                                                <div class="wishlist">
                                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Add to Wishlist"><i class="fa-regular fa-heart"></i></span>
                                                </div>
                                            </div>
                                            <div class="product_content">
                                                <h4><a href="#">HP OfficeJet Pro 9125e All-in-One Printer</a></h4>
                                                <div class="price">
                                                    <del>$180.00</del>
                                                    <ins>$109.00</ins>
                                                </div>
                                                <div class="rating">
                                                    <span class="fa-solid fa-star"></span>
                                                    <span class="fa-solid fa-star"></span>
                                                    <span class="fa-solid fa-star"></span>
                                                    <span class="fa-solid fa-star"></span>
                                                    <span class="fa-regular fa-star"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>

                                <ul class="pagination cuspagination mt-4 pt-3 gap-1 justify-content-center">
                                    <li class="disabled"><a href="#"><i class="fa-solid fa-arrow-left"></i></a></li>
                                    <li class="page_item active"><a href="#">1</a></li>
                                    <li class="page_item"><a href="#">2</a></li>
                                    <li class="page_item"><a href="#">3</a></li>
                                    <li class="page_item dots"><span>...</span></li>
                                    <li class="page_item"><a href="#">7</a></li>
                                    <li class="page_item"><a href="#">8</a></li>
                                    <li><a href="#"><i class="fa-solid fa-arrow-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
@endsection
