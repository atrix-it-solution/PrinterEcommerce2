@extends('layouts.frontend.master')

@section('title', 'Blog')

@section('content')
<div class="bodyWrapper flex-grow-1">
    <section class="subheader py-5">
        <div class="container py-lg-5">
            <div class="row py-lg-4">
                <div class="col-md-6 text-white">
                    <h1>Our Blog</h1>
                    <p class="mb-0 fw-light">Get to know any questions of what values we provide and believe in</p>
                </div>
            </div>
        </div>
    </section>

    <div class="blog_sec py-5">
        <div class="container py-lg-5">
            <div class="row gx-lg-4">
                @forelse($blogs as $blog)
                <div class="col-md-6 col-lg-4 my-3">
                    <div class="blog_box h-100 d-flex flex-column overflow-hidden rounded-3 bg-white shadow-lg p-2 border">
                        <a href="{{ route('frontend.blog.single', $blog->slug) }}" class="blog_img">
                         
                                <img src="{{ Storage::url($blog->featuredImage->file_path) }}" alt="{{ $blog->title }}" class="img-fluid h-100 w-100 object-fit-cover" style="height: 200px; object-fit: cover;" />
                           
                         
                        </a>
                        <div class="blog_content flex-grow-1 d-flex flex-column p-3 px-2">
                            <h4 class="fw-normal">
                                <a href="{{ route('frontend.blog.single', $blog->slug) }}">{{ $blog->title }}</a>
                            </h4>
                            
                            <p class="mb-1 text-muted small">
                                {{ $blog->created_at->format('M j, Y') }} • 
                                @if($blog->categories->count() > 0)
                                    {{ $blog->categories->first()->name }}
                                @else
                                    Uncategorized
                                @endif
                            </p>
                            
                            <p class="pb-1">
                                @if($blog->description)
                                    {{ Str::limit(strip_tags($blog->description), 150) }}
                                @else
                                    No description available.
                                @endif
                            </p>
                            
                            <div class="readmore mt-auto">
                                <a href="{{ route('frontend.blog.single', $blog->slug) }}" class="cusbtn">Read More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <h3>No blogs found</h3>
                    <p>Check back later for new articles!</p>
                </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($blogs->hasPages())
            <ul class="pagination cuspagination mt-4 pt-4 gap-1 justify-content-center">
                {{-- Previous Page Link --}}
                @if($blogs->onFirstPage())
                    <li class="disabled"><span><i class="fa-solid fa-arrow-left"></i></span></li>
                @else
                    <li><a href="{{ $blogs->previousPageUrl() }}"><i class="fa-solid fa-arrow-left"></i></a></li>
                @endif

                {{-- Pagination Elements --}}
                @foreach($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                    @if($page == $blogs->currentPage())
                        <li class="page_item active"><span>{{ $page }}</span></li>
                    @else
                        <li class="page_item"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if($blogs->hasMorePages())
                    <li><a href="{{ $blogs->nextPageUrl() }}"><i class="fa-solid fa-arrow-right"></i></a></li>
                @else
                    <li class="disabled"><span><i class="fa-solid fa-arrow-right"></i></span></li>
                @endif
            </ul>
            @endif
        </div>
    </div>

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