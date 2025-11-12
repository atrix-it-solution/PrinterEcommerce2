@extends('layouts.frontend.master')

@section('title', $blog->title)

@section('content')
<div class="bodyWrapper flex-grow-1">
    <section class="shop_header py-5">
        <div class="container text-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-1">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('frontend.blog.index') }}">Blog</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $blog->title }}</li>
                </ol>
            </nav>
            <h1 class="mb-0 text-white">{{ $blog->title }}</h1>
        </div>
    </section>

    <section class="blog_single_wrap py-5">
        <div class="container py-lg-3">
            <div class="row gx-lg-5">
                {{-- Sidebar --}}
                <div class="col-lg-3 my-2">
                    <div class="blogsidebar sticky-top">
                        {{-- Search --}}
                        <div class="searchbar widget">
                            <form action="{{ route('frontend.blog.index') }}" method="GET">
                                <div class="inputbar">
                                    <label for="search" class="d-none">Search</label>
                                    <input type="search" name="search" class="form-control" id="search" placeholder="Search" value="{{ request('search') }}" />
                                    <button type="submit" class="iconbtn"><i class="fa-solid fa-search"></i></button>
                                </div>
                            </form>
                        </div>

                        {{-- Recent Posts --}}
                        <div class="recent_post widget">
                            <h4 class="widget_title">Recent posts</h4>
                            <ul class="list-unstyled">
                                @php
                                    $recentBlogs = \App\Models\Blog\Blog::with('featuredImage')
                                        ->orderBy('created_at', 'desc')
                                        ->limit(4)
                                        ->get();
                                @endphp
                                @foreach($recentBlogs as $recentBlog)
                                <li>
                                    <a href="{{ route('frontend.blog.single', $recentBlog->slug) }}" class="rblog_box">
                                        <div class="blog_img">
                                           
                                                <img src="{{ Storage::url($recentBlog->featuredImage->file_path) }}" alt="{{ $recentBlog->title }}" class="img-fluid" style="width: 60px; height: 60px; object-fit: cover;" />
                                           

                                        </div>
                                        <div class="rblog_content">
                                            <h5>{{ Str::limit($recentBlog->title, 40) }}</h5>
                                            <div class="blog_date">{{ $recentBlog->created_at->format('F j, Y') }}</div>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- Categories --}}
                        <div class="blog_tags widget">
                            <h4 class="widget_title">Categories</h4>
                            <ul class="list-unstyled">
                                @php
                                    $categories = \App\Models\Blog\BlogCategory::withCount('blogs')->get();
                                @endphp
                                @foreach($categories as $category)
                                    <li><a href="{{ route('frontend.blog.index', ['category' => $category->id]) }}">{{ $category->title }} ({{ $category->blogs_count }})</a></li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- Tags --}}
                        @if($blog->tags)
                        <div class="blog_tags widget">
                            <h4 class="widget_title">Tags</h4>
                            <ul class="list-unstyled">
                                @foreach(explode(',', $blog->tags) as $tag)
                                    <li><a href="{{ route('frontend.blog.index', ['tag' => trim($tag)]) }}">{{ trim($tag) }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        {{-- Newsletter --}}
                        <div class="newsletter widget">
                            <h4 class="widget_title">Newsletter</h4>
                            <form action="">
                                <div class="inputbar">
                                    <label for="email" class="d-none">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Your Email" />
                                    <button type="submit" class="iconbtn"><i class="fa-regular fa-envelope"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="col-lg-9 my-2">
                    <article class="blog_single">
                        {{-- Featured Image --}}
                       
                        <div class="featured_img">
                            <img src="{{ Storage::url($blog->featuredImage->file_path) }}" alt="{{ $blog->title }}" class="img-fluid w-100" style="max-height: 500px; object-fit: cover;" />
                        </div>
                       

                        {{-- Blog Meta --}}
                        <div class="blog_meta">
                            <span class="blog_date">{{ $blog->created_at->format('F j, Y') }}</span> 
                            @if($blog->categories->count() > 0)
                                <span class="slash">/</span> 
                                <span class="blog_cat">
                                    @foreach($blog->categories as $category)
                                        {{ $category->name }}@if(!$loop->last), @endif
                                    @endforeach
                                </span>
                            @endif
                        </div>

                        {{-- Blog Content --}}
                        <div class="blogContent">
                            {!! $blog->description !!}
                        </div>

                        {{-- Tags --}}
                        @if($blog->tags)
                        <div class="blog_btm pt-4 d-flex justify-content-between align-items-center gap-3">
                            <div class="blog_tags">
                                <ul class="list-unstyled mb-lg-0 d-flex flex-wrap gap-2">
                                    @foreach(explode(',', $blog->tags) as $tag)
                                        <li><a href="{{ route('frontend.blog.index', ['tag' => trim($tag)]) }}">{{ trim($tag) }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="blog_share">
                                {{-- Add social sharing buttons here --}}
                                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                                <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
                            </div>
                        </div>
                        @endif

                        {{-- Navigation --}}
                        @php
                            $prevBlog = \App\Models\Blog\Blog::where('id', '<', $blog->id)->orderBy('id', 'desc')->first();
                            $nextBlog = \App\Models\Blog\Blog::where('id', '>', $blog->id)->orderBy('id', 'asc')->first();
                        @endphp
                        <div class="prev_next d-flex justify-content-between align-items-center gap-3 mt-4 pt-4 border-top">
                            @if($prevBlog)
                                <a href="{{ route('frontend.blog.single', $prevBlog->slug) }}"><i class="fa-solid fa-arrow-left me-2"></i> Prev Post</a>
                            @else
                                <span></span>
                            @endif
                            
                            @if($nextBlog)
                                <a href="{{ route('frontend.blog.single', $nextBlog->slug) }}">Next Post <i class="fa-solid fa-arrow-right ms-2"></i></a>
                            @else
                                <span></span>
                            @endif
                        </div>
                    </article>

                    {{-- Related Blogs --}}
                    @if($relatedBlogs->count() > 0)
                    <div class="related_blogs mt-5 pt-5">
                        <h3 class="mb-4">Related Articles</h3>
                        <div class="row gx-lg-4">
                            @foreach($relatedBlogs as $relatedBlog)
                            <div class="col-md-4 my-3">
                                <div class="blog_box h-100 d-flex flex-column overflow-hidden rounded-3 bg-white shadow-lg p-2 border">
                                    <a href="{{ route('frontend.blog.single', $relatedBlog->slug) }}" class="blog_img">
                                 
                                            <img src="{{ Storage::url($relatedBlog->featuredImage->file_path) }}" alt="{{ $relatedBlog->title }}" class="img-fluid h-100 w-100 object-fit-cover" style="height: 150px; object-fit: cover;" />
                                       
                                        
                                    </a>
                                    <div class="blog_content flex-grow-1 d-flex flex-column p-3 px-2">
                                        <h5 class="fw-normal">
                                            <a href="{{ route('frontend.blog.single', $relatedBlog->slug) }}">{{ Str::limit($relatedBlog->title, 50) }}</a>
                                        </h5>
                                        <div class="readmore mt-auto">
                                            <a href="{{ route('frontend.blog.single', $relatedBlog->slug) }}" class="cusbtn">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection