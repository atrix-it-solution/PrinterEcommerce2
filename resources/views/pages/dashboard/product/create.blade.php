@extends('layouts.dashboard.master')

@section('title', isset($product) ? 'Edit Product' : 'Add Product')

@section('dashboard-content')
<div class="container-fluid">
     <!-- Debug Errors -->
    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif
        
        <div class="row">
            <!-- Left side -->
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Product Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Product title" 
                                   value="{{ old('title', $product->title ?? '') }}">
                            @error('title')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                          
                          <div class="mt-2">
                              <label class="form-label">Slug</label>
                              <div class="input-group">
                                  <input type="text" name="slug" id="slugInput" class="form-control" 
                                         value="{{ old('slug', $product->slug ?? '') }}" 
                                         placeholder="slug" readonly>
                                  <button type="button" class="btn btn-outline-secondary" onclick="enableSlugEditing()" id="editSlugBtn">
                                      <i class="fas fa-edit"></i> Edit
                                  </button>
                              </div>
                              @error('slug')
                                <div class="text-danger small">{{ $message }}</div>
                              @enderror
                          </div>
                        </div>

                        <!-- Description (with CKEditor) -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="6">{{ old('description', $product->description ?? '') }}</textarea>
                            @error('description')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="regular_price" class="form-label">Regular Price ($)</label>
                            <input type="number" step="0.01" name="regular_price" id="regular_price" class="form-control" 
                                   value="{{ old('regular_price', $product->regular_price ?? '') }}" placeholder="Regular Price">   
                            @error('regular_price')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sale_price" class="form-label">Sale Price ($)</label>
                            <input type="number" step="0.01" name="sale_price" id="sale_price" class="form-control" 
                                   value="{{ old('sale_price', $product->sale_price ?? '') }}" placeholder="Sale Price">   
                            @error('sale_price')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sku" class="form-label">SKU</label>
                            <input type="text" name="sku" id="sku" class="form-control" 
                                value="{{ old('sku', $product->sku ?? '') }}" placeholder="Stock Keeping Unit">   
                            @error('sku')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
    <div class="form-check mb-2">
        <input class="form-check-input" type="checkbox" name="manage_stock" id="manageStock" value="1"
            {{ old('manage_stock', isset($product) && !is_null($product->stock_quantity) ? 'checked' : '') }}>
        <label class="form-check-label" for="manageStock">
            Manage stock quantity
        </label>
    </div>
    
    <div id="stockQuantityField" style="{{ old('manage_stock', isset($product) && !is_null($product->stock_quantity) ? '' : 'display:none;') }}">
        <label for="stock_quantity" class="form-label">Stock Quantity</label>
        <input type="number" name="stock_quantity" id="stock_quantity" class="form-control" 
            value="{{ old('stock_quantity', isset($product) && !is_null($product->stock_quantity) ? $product->stock_quantity : '') }}" 
            placeholder="Enter stock quantity" min="0">
        <small class="text-muted">Leave empty for unlimited stock</small>
        @error('stock_quantity')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
</div>
                    </div>
                </div>
            </div>

            <!-- Right side -->
            <div class="col-md-2">
                <div class="d-grid gap-2 mb-3">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($product) ? 'Update Product' : 'Publish Product' }}
                    </button>
                </div>

                <!-- Featured Image -->
                <div class="card mb-3">
                    <div class="card-body">
                        <label class="form-label">Featured Image</label>
                            <div>
                                <button type="button" class="setMediaBtn" data-bs-toggle="modal" data-bs-target="#uploadImageModal" 
                                        onclick="setImageType('featured_image')">
                                    Set Featured Image
                                </button>
                            </div>
                         
                            <div id="featuredimageContainer" style="{{ isset($product) && $product->featuredImage ? '' : 'display:none;' }} margin-top:10px;">
                                <div class="frontend-item d-inline-block position-relative">
                                    <img id="featuredimageImage" src="{{ isset($product) && $product->featuredImage->url ? asset($product->featuredImage->url) : '' }}" 
                                         class="img-fluid rounded border" style="max-height:100px;">
                                    <button type="button" class="btn btn-danger btn-sm btn-remove position-absolute top-0 end-0 m-1"
                                            onclick="removeImage('featured_image')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="featured_image" id="featuredimageInput" value="{{ old('featured_image', $product->featured_image ?? '') }}">
                        
                    </div>
                </div>

                  <!-- Categories -->
                <div class="card mb-3">
                    <div class="card-body">
                        <label class="form-label">Categories</label>
                        <div class="d-flex flex-column">
                            @foreach($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input" 
                                        type="checkbox" 
                                        name="categories[]" 
                                        value="{{ $category->id }}" 
                                        id="category-{{ $category->id }}"
                                        {{ in_array($category->id, old('categories', isset($product) ? $product->categories->pluck('id')->toArray() : [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="category-{{ $category->id }}">
                                        {{ $category->title }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('categories')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                        @error('categories.*')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

               <!-- Gallery Images -->
                <div class="card mb-3">
                    <div class="card-body">
                        <label class="form-label">Gallery Images</label>
                        <div>
                            <button type="button" class="setMediaBtn" data-bs-toggle="modal" data-bs-target="#uploadImageModal" 
                                    onclick="setImageType('gallery_images')">
                                Add Gallery Images
                            </button>
                        </div>
                        
                        <!-- Gallery Images Container -->
                        <div id="galleryImagesContainer" class="mt-3">
                            @if(isset($product) && $product->galleryImages->count() > 0)
                                @foreach($product->galleryImages as $galleryImage)
                                    <div class="gallery-item d-inline-block position-relative me-2 mb-2" data-media-id="{{ $galleryImage->id }}">
                                        <img src="{{ asset($galleryImage->url) }}" 
                                            class="img-fluid rounded border" style="max-height:100px;">
                                        <button type="button" class="btn btn-danger btn-sm btn-remove position-absolute top-0 end-0 m-1"
                                                onclick="removeGalleryImage({{ $galleryImage->id }})">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        
                        <!-- Hidden input to store gallery image IDs -->
                        <input type="hidden" name="gallery_images" id="galleryImagesInput" 
                            value="{{ old('gallery_images', isset($product) ? $product->galleryImages->pluck('id')->implode(',') : '') }}">
                    </div>
                </div>


            </div>
        </div>
    </form>
    @include('pages.dashboard.common.media.index')

</div>


@endsection