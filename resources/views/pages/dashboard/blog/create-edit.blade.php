@extends('layouts.dashboard.master')

@section('title', isset($blog) ? 'Edit Blog' : 'Add Blog')

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
    <form action="{{ isset($blog) ? route('blogs.update', $blog->id) : route('blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($blog))
            @method('PUT')
        @endif
        
        <div class="row">
            <!-- Left side -->
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Blog Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Blog title" 
                                   value="{{ old('title', $blog->title ?? '') }}">
                            @error('title')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                          
                          <div class="mt-2">
                              <label class="form-label">Slug</label>
                              <div class="input-group">
                                  <input type="text" name="slug" id="slugInput" class="form-control" 
                                         value="{{ old('slug', $blog->slug ?? '') }}" 
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
                            <textarea name="description" id="description" class="form-control" rows="6">{{ old('description', $blog->description ?? '') }}</textarea>
                            @error('description')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right side -->
            <div class="col-md-2">
                <div class="d-grid gap-2 mb-3">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($blog) ? 'Update Blog' : 'Publish Blog' }}
                    </button>
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
                                        {{ in_array($category->id, old('categories', isset($blog) ? $blog->categories->pluck('id')->toArray() : [])) ? 'checked' : '' }}>
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
                    
                        <div id="featuredimageContainer" style="{{ isset($blog) && $blog->featuredImage ? '' : 'display:none;' }} margin-top:10px;">
                            <div class="frontend-item d-inline-block position-relative">
                                @if(isset($blog) && $blog->featuredImage)
                                    <img id="featuredimageImage" src="{{ $blog->featuredImage->url }}" 
                                        class="img-fluid rounded border" style="max-height:100px;">
                                @else
                                    <img id="featuredimageImage" src="" class="img-fluid rounded border" style="max-height:100px; display:none;">
                                @endif
                                <button type="button" class="btn btn-danger btn-sm btn-remove position-absolute top-0 end-0 m-1"
                                        onclick="removeImage('featured_image')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- Store media ID, not URL -->
                        <input type="hidden" name="featured_image" id="featuredimageInput" value="{{ old('featured_image', $blog->featured_image ?? '') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="tagsInput" class="form-label">Tags</label>
                    <div class="tags-input-container">
                        <div class="tags-display" id="tagsDisplay">
                            <!-- Tags will appear here -->
                            @if(isset($blog) && $blog->tags)
                                @foreach(explode(',', $blog->tags) as $tag)
                                    @if(trim($tag))
                                        <span class="tag">
                                            {{ trim($tag) }}
                                            <span class="remove-tag" >×</span>
                                        </span>
                                    @endif
                                @endforeach
                            @endif
                            <input type="text" 
                                id="tagsInput" 
                                class="form-control tags-input" 
                                placeholder="Type tag "
                                autocomplete="off">
                        </div>
                        <input type="hidden" name="tags" id="tagsHidden" value="{{ old('tags', $blog->tags ?? '') }}">
                    </div>
                    <small class="text-muted">Type tag and press Enter, Space, or Comma to add. Click × to remove.</small>
                    @error('tags')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                
            </div>
        </div>
    </form>
    @include('pages.dashboard.common.media.index')

</div>
<style>
.tags-input-container {
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
    padding: 0.375rem 0.75rem;
    background: white;
    min-height: 45px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 0.5rem;
}

.tags-input-container:focus-within {
    border-color: #86b7fe;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.tags-display {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    flex: 1;
}

.tag {
    display: inline-flex;
    align-items: center;
    background-color: #007bff;
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.875rem;
    font-weight: 500;
}

.remove-tag {
    margin-left: 0.5rem;
    cursor: pointer;
    font-weight: bold;
    font-size: 1.1rem;
    line-height: 1;
}

.remove-tag:hover {
    color: #ffcccb;
}

.tags-input {
    border: none !important;
    outline: none !important;
    box-shadow: none !important;
    flex: 1;
    min-width: 120px;
    padding: 0.25rem 0;
}

.tags-input:focus {
    border: none !important;
    outline: none !important;
    box-shadow: none !important;
}
</style>

<script>
class TagsInput {
    constructor(container) {
        this.tagsInput = container.querySelector('#tagsInput');
        this.tagsDisplay = container.querySelector('#tagsDisplay');
        this.tagsHidden = container.querySelector('#tagsHidden');
        
        this.init();
    }
    
    init() {
        this.tagsInput.addEventListener('keydown', this.handleKeydown.bind(this));
        this.tagsInput.addEventListener('blur', this.handleBlur.bind(this));
        
        // Add event listeners to all remove buttons (including existing ones)
        this.attachRemoveEvents();
        this.updateHiddenInput();
    }
    
    attachRemoveEvents() {
        const removeButtons = this.tagsDisplay.querySelectorAll('.remove-tag');
        removeButtons.forEach(removeBtn => {
            removeBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                this.removeTag(removeBtn);
            });
        });
    }
    
    handleKeydown(e) {
        if (e.key === 'Enter' || e.key === ' ' || e.key === ',') {
            e.preventDefault();
            this.addTag(this.tagsInput.value.trim());
            this.tagsInput.value = '';
        }
        
        if (e.key === 'Backspace' && this.tagsInput.value === '') {
            const tags = this.tagsDisplay.querySelectorAll('.tag');
            if (tags.length > 0) {
                this.removeTag(tags[tags.length - 1].querySelector('.remove-tag'));
            }
        }
    }
    
    handleBlur() {
        if (this.tagsInput.value.trim()) {
            this.addTag(this.tagsInput.value.trim());
            this.tagsInput.value = '';
        }
    }
    
    addTag(tagText) {
        if (!tagText) return;
        
        const existingTags = Array.from(this.tagsDisplay.querySelectorAll('.tag'))
            .map(tag => tag.textContent.replace('×', '').trim());
            
        if (existingTags.includes(tagText)) return;
        
        const tagElement = document.createElement('span');
        tagElement.className = 'tag';
        tagElement.innerHTML = `
            ${tagText}
            <span class="remove-tag">×</span>
        `;
        
        // Add click event to remove button
        tagElement.querySelector('.remove-tag').addEventListener('click', (e) => {
            e.stopPropagation();
            this.removeTag(tagElement.querySelector('.remove-tag'));
        });
        
        // Insert before the input field
        this.tagsDisplay.insertBefore(tagElement, this.tagsInput);
        this.updateHiddenInput();
    }
    
    removeTag(removeButton) {
        removeButton.parentElement.remove();
        this.updateHiddenInput();
    }
    
    updateHiddenInput() {
        const tags = Array.from(this.tagsDisplay.querySelectorAll('.tag'))
            .map(tag => tag.textContent.replace('×', '').trim())
            .filter(tag => tag !== '');
            
        this.tagsHidden.value = tags.join(',');
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    const tagsContainer = document.querySelector('.tags-input-container');
    if (tagsContainer) {
        new TagsInput(tagsContainer);
    }
    
    // Auto-slug generation from title
    document.getElementById('title').addEventListener('input', function() {
        const slugInput = document.getElementById('slugInput');
        if (!slugInput.hasAttribute('readonly')) return;
        
        const title = this.value;
        const slug = title.toLowerCase()
            .replace(/[^a-z0-9 -]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim();
        
        slugInput.value = slug;
    });
    
    window.enableSlugEditing = function() {
        const slugInput = document.getElementById('slugInput');
        const editBtn = document.getElementById('editSlugBtn');
        
        slugInput.removeAttribute('readonly');
        editBtn.style.display = 'none';
    };
});
</script>

@endsection