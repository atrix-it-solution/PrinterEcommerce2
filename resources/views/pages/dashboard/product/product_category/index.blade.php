@extends('layouts.dashboard.master')

@section('title', 'Category Product')

@section('dashboard-content')
<div class="container-fluid">

   
    <!-- @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif -->

    <div class="row">

        
        <div class="col-md-4">
            <div class="card-body">

                    @if(!empty($editCategory))
                        {{-- Edit Mode --}}
                        <form action="{{ route('productcategories.update', $editCategory->id) }}" method="POST">
                            @method('PUT')
                    @else
                        {{-- Create Mode --}}
                        <form action="{{ route('productcategories.store') }}" method="POST">
                    @endif
                    @csrf

                  
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control"
                               value="{{ old('title', $editCategory->title ?? '') }}" required>
                    </div>

                    
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control"
                               value="{{ old('slug', $editCategory->slug ?? '') }}" required>
                    </div>

                     <div class="mb-3">
                    <label class="form-label">Category Image</label>
                    <div>
                        <button type="button" class="setMediaBtn" data-bs-toggle="modal" data-bs-target="#uploadImageModal" 
                                onclick="setImageType('category_image')">
                            Set Category Image
                        </button>
                    </div>
                
                    <div id="categoryimageContainer" style="{{ isset($editCategory) && $editCategory->categoryImage ? '' : 'display:none;' }} margin-top:10px;">
                        <div class="frontend-item d-inline-block position-relative">
                            <img id="categoryimageImage" src="{{ isset($editCategory) && $editCategory->categoryImage ? asset($editCategory->categoryImage->url) : '' }}" 
                                class="img-fluid rounded border" style="max-height:100px;">
                            <button type="button" class="btn btn-danger btn-sm btn-remove position-absolute top-0 end-0 m-1"
                                    onclick="removeImage('category_image')">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- Store the MEDIA ID, not the URL -->
                    <input type="hidden" name="category_image" id="categoryimageInput" 
                           value="{{ old('category_image', $editCategory->category_image ?? '') }}">
                </div>

                     @include('pages.dashboard.common.media.index')
                     
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" name="description" class="form-control"
                               value="{{ old('description', $editCategory->description ?? '') }}">
                    </div>

                    

                    
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($editCategory) ? 'Update' : 'Publish' }}
                        </button>
                        @if(isset($editCategory))
                            <a href="{{ route('productcategories.index') }}" class="btn btn-secondary">Cancel</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>


        <div class="col-md-8">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td>
                                            @if($category->categoryImage)
                                                <img src="{{ asset($category->categoryImage->url) }}" 
                                                     alt="{{ $category->title }}" 
                                                     style="max-height: 50px; max-width: 50px; object-fit: cover;">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>
                                        <td>{{ $category->title }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>
                                            <a href="{{ route('productcategories.edit', $category->id) }}"
                                               class="btn btn-sm btn-warning">Edit</a>

                                            <form action="{{ route('productcategories.destroy', $category->id) }}"
                                                  method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center">No categories found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
