// media.js - Updated for multiple gallery images

// Global variables
window.selectedImagePath = null;
window.selectedImageElement = null;
window.images = [];
window.currentImageType = null;
window.selectedGalleryImages = new Set(); // Store multiple selected images for gallery

// Set image type function
window.setImageType = function(type) {
    window.currentImageType = type;
    window.selectedGalleryImages.clear(); // Clear previous selections
    
    if (type === 'gallery_images') {
        // Show multiple selection mode
        document.querySelectorAll('.image-container').forEach(container => {
            container.classList.remove('selected');
        });
        console.log('Gallery image mode activated - multiple selection enabled');
    } else {
        // Single selection mode for other image types
        console.log('Single image mode activated for:', type);
    }
};

// Set as media image function
window.setAsMediaImage = function() {
    if (!window.selectedImagePath && window.currentImageType !== 'gallery_images') {
        alert('Please select an image first!');
        return;
    }

    if (!window.currentImageType) {
        alert('Please specify image type first!');
        return;
    }

    const mediaId = window.selectedImageElement ? window.selectedImageElement.getAttribute('data-id') : null;
    const imageUrl = window.selectedImagePath;
    const selectedPath = window.selectedImagePath;

    switch(window.currentImageType) {
        case 'site_icon':
            document.getElementById('siteIconImage').src = selectedPath;
            document.getElementById('siteIconContainer').style.display = 'block';
            document.getElementById('siteIconInput').value = selectedPath;
            break;
        case 'site_logo':
            document.getElementById('siteLogoImage').src = selectedPath;
            document.getElementById('siteLogoContainer').style.display = 'block';
            document.getElementById('siteLogoInput').value = selectedPath;
            break;
        case 'site_footer_logo':
            document.getElementById('footerLogoImage').src = selectedPath;
            document.getElementById('footerLogoContainer').style.display = 'block';
            document.getElementById('footerLogoInput').value = selectedPath;
            break;
        case 'featured_image':
            document.getElementById('featuredimageImage').src = selectedPath;
            document.getElementById('featuredimageContainer').style.display = 'block';
            document.getElementById('featuredimageInput').value = mediaId;
            break;
        case 'category_image':
            document.getElementById('categoryimageImage').src = selectedPath;
            document.getElementById('categoryimageContainer').style.display = 'block';
            document.getElementById('categoryimageInput').value = mediaId;
            break;
        case 'gallery_images':
            // Handle multiple gallery images
            this.addGalleryImages();
            return; // Don't close modal for gallery images
            break;
    }

    // Close modal for single image selections
    this.closeMediaModal();
};

// Add multiple gallery images
window.addGalleryImages = function() {
    if (window.selectedGalleryImages.size === 0) {
        alert('Please select at least one image for the gallery!');
        return;
    }

    const galleryContainer = document.getElementById('galleryImagesContainer');
    const galleryInput = document.getElementById('galleryImagesInput');
    
    // Get current gallery image IDs
    let currentGalleryIds = galleryInput.value ? galleryInput.value.split(',').map(id => id.trim()) : [];
    
    // Add new images
    window.selectedGalleryImages.forEach(imageData => {
        // Check if image already exists in gallery
        if (!currentGalleryIds.includes(imageData.id.toString())) {
            // Create gallery item
            const galleryItem = document.createElement('div');
            galleryItem.className = 'gallery-item d-inline-block position-relative me-2 mb-2';
            galleryItem.setAttribute('data-media-id', imageData.id);
            galleryItem.innerHTML = `
                <img src="${imageData.url}" 
                     class="img-fluid rounded border" style="max-height:100px;">
                <button type="button" class="btn btn-danger btn-sm btn-remove position-absolute top-0 end-0 m-1"
                        onclick="removeGalleryImage(${imageData.id})">
                    <i class="fas fa-times"></i>
                </button>
            `;
            galleryContainer.appendChild(galleryItem);
            
            // Add to current IDs
            currentGalleryIds.push(imageData.id.toString());
        }
    });
    
    // Update hidden input
    galleryInput.value = currentGalleryIds.join(',');
    
    // Clear selections and close modal
    window.selectedGalleryImages.clear();
    this.closeMediaModal();
    
    console.log('Gallery images updated:', galleryInput.value);
};

// Remove single gallery image
window.removeGalleryImage = function(mediaId) {
    const galleryContainer = document.getElementById('galleryImagesContainer');
    const galleryInput = document.getElementById('galleryImagesInput');
    
    // Remove from DOM
    const galleryItem = document.querySelector(`.gallery-item[data-media-id="${mediaId}"]`);
    if (galleryItem) {
        galleryItem.remove();
    }
    
    // Update hidden input
    let currentGalleryIds = galleryInput.value ? galleryInput.value.split(',').map(id => id.trim()) : [];
    currentGalleryIds = currentGalleryIds.filter(id => id !== mediaId.toString());
    galleryInput.value = currentGalleryIds.join(',');
    
    console.log('Removed gallery image:', mediaId, 'Current:', galleryInput.value);
};

// Close media modal
window.closeMediaModal = function() {
    const modal = bootstrap.Modal.getInstance(document.getElementById('uploadImageModal'));
    if (modal) {
        modal.hide();
    }
};

// Remove image function for single images
window.removeImage = function(type) {
    switch(type) {
        case 'site_icon':
            document.getElementById('siteIconContainer').style.display = 'none';
            document.getElementById('siteIconImage').src = '';
            document.getElementById('siteIconInput').value = '';
            break;
        case 'site_logo':
            document.getElementById('siteLogoContainer').style.display = 'none';
            document.getElementById('siteLogoImage').src = '';
            document.getElementById('siteLogoInput').value = '';
            break;
        case 'site_footer_logo':
            document.getElementById('footerLogoContainer').style.display = 'none';
            document.getElementById('footerLogoImage').src = '';
            document.getElementById('footerLogoInput').value = '';
            break;
        case 'featured_image':
            document.getElementById('featuredimageContainer').style.display = 'none';
            document.getElementById('featuredimageImage').src = '';
            document.getElementById('featuredimageInput').value = '';
            break;
        case 'category_image':
            document.getElementById('categoryimageContainer').style.display = 'none';
            document.getElementById('categoryimageImage').src = '';
            document.getElementById('categoryimageInput').value = '';
            break;
        case 'gallery_images':
            // Clear all gallery images
            document.getElementById('galleryImagesContainer').innerHTML = '';
            document.getElementById('galleryImagesInput').value = '';
            break;
    }
};

// Select image function (updated for multiple selection)
function selectImage(element, imageUrl, imageName, imageId) {
    if (window.currentImageType === 'gallery_images') {
        // Multiple selection mode for gallery images
        const imageData = {
            id: imageId,
            url: imageUrl,
            name: imageName
        };
        
        if (element.classList.contains('selected')) {
            // Deselect image
            element.classList.remove('selected');
            window.selectedGalleryImages.delete(imageData.id);
            console.log('Deselected gallery image:', imageData.id);
        } else {
            // Select image
            element.classList.add('selected');
            window.selectedGalleryImages.add(imageData);
            console.log('Selected gallery image:', imageData.id);
        }
        
        // Update selection count display
        this.updateSelectionCount();
        
    } else {
        // Single selection mode for other image types
        document.querySelectorAll('.image-container').forEach(img => {
            img.classList.remove('selected');
        });
        
        element.classList.add('selected');
        window.selectedImagePath = imageUrl;
        window.selectedImageElement = element;

        console.log('Selected single image ID:', element.getAttribute('data-id'));
        console.log('Selected single image URL:', imageUrl);
    }
}

// Update selection count display
window.updateSelectionCount = function() {
    let selectionInfo = document.getElementById('selectionInfo');
    if (!selectionInfo) {
        // Create selection info element if it doesn't exist
        selectionInfo = document.createElement('div');
        selectionInfo.id = 'selectionInfo';
        selectionInfo.className = 'alert alert-info mt-3';
        document.querySelector('.modal-body').prepend(selectionInfo);
    }
    
    // if (window.currentImageType === 'gallery_images') {
    //     selectionInfo.innerHTML = `
    //         <strong>Gallery Mode:</strong> ${window.selectedGalleryImages.size} image(s) selected.
    //         <br><small>Click images to select/deselect multiple images for gallery.</small>
    //     `;
    //     selectionInfo.style.display = 'block';
    // } else {
    //     selectionInfo.style.display = 'none';
    // }
};

// The rest of your existing media.js code with updated selectImage calls
document.addEventListener('DOMContentLoaded', function () {
    // Modal
    const modal = document.getElementById('uploadImageModal');
    if (modal) {
        modal.addEventListener('shown.bs.modal', function () {
            loadImages();
        });
        
        modal.addEventListener('hidden.bs.modal', function () {
            // Reset selections when modal closes
            window.selectedGalleryImages.clear();
            document.querySelectorAll('.image-container').forEach(img => {
                img.classList.remove('selected');
            });
        });
    }

    // Drag & Drop
    initDragAndDrop();
});

function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}

function initDragAndDrop() {
    const uploadArea = document.querySelector('.upload-area');
    if (!uploadArea) return;

    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.style.borderColor = '#6c5ce7';
        this.style.backgroundColor = '#f0f0ff';
    });
    
    uploadArea.addEventListener('dragleave', function() {
        this.style.borderColor = '#ccc';
        this.style.backgroundColor = '#f9f9f9';
    });
    
    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        this.style.borderColor = '#ccc';
        this.style.backgroundColor = '#f9f9f9';
        
        if (e.dataTransfer.files.length) {
            document.getElementById('imageInput').files = e.dataTransfer.files;
            handleImageUpload({ target: document.getElementById('imageInput') });
        }
    });
}

function handleImageUpload(event) {
    const file = event.target.files[0];
    if (!file) return;
    
    const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/avif'];
    const maxSize = 4 * 1024 * 1024;

    if (!validTypes.includes(file.type)) {
        alert('Please select a valid image file (JPEG, PNG, GIF, WEBP)');
        return;
    }

    if (file.size > maxSize) {
        alert('Image size should be less than 4MB');
        return;
    }
    
    let reader = new FileReader();
    reader.onload = function(){
        let preview = document.getElementById('uploadPreview');
        preview.src = reader.result;
        preview.style.display = "block";
        uploadImage(file);
    };
    reader.readAsDataURL(file);
}

function loadImages() {
    const gallery = document.getElementById('imageGallery');
    gallery.innerHTML = `
        <div class="col-12 text-center py-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Loading images...</p>
        </div>
    `;
    
    fetch('/api/media')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            window.images = data;
            renderImageGallery();
            // Update selection count display
            window.updateSelectionCount();
        })
        .catch(error => {
            console.error('Error loading images:', error);
            gallery.innerHTML = `
                <div class="col-12 text-center py-4">
                    <div class="text-danger">
                        <i class="fas fa-exclamation-circle fa-2x mb-2"></i>
                        <p>Error loading images: ${error.message}</p>
                        <button class="mediabtn btn-sm" onclick="loadImages()">
                            <i class="fas fa-sync-alt me-1"></i>Retry
                        </button>
                    </div>
                </div>
            `;
        });
}

function uploadImage(file) {
    const formData = new FormData();
    formData.append('image', file);
    formData.append('_token', getCsrfToken());
    
    const uploadArea = document.querySelector('.upload-area');
    uploadArea.innerHTML = `
        <div class="text-center">
            <div class="spinner-border text-primary mb-3" role="status">
                <span class="visually-hidden">Uploading...</span>
            </div>
            <p>Uploading image...</p>
        </div>
    `;
    
    fetch('/api/media/upload', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': getCsrfToken(),
            'Accept': 'application/json'
        }
    })
    .then(async response => {
        const responseText = await response.text();
        
        if (!response.ok) {
            console.error('Server response:', responseText);
            
            let errorMessage = 'Upload failed';
            try {
                const errorData = JSON.parse(responseText);
                if (errorData.errors && errorData.errors.image) {
                    errorMessage = errorData.errors.image[0];
                } else if (errorData.error) {
                    errorMessage = errorData.error;
                } else if (errorData.message) {
                    errorMessage = errorData.message;
                }
            } catch (e) {
                errorMessage = 'Server error: ' + response.status;
            }
            
            throw new Error(errorMessage);
        }
        
        return JSON.parse(responseText);
    })
    .then(data => {
        window.images.push(data);
        
        const galleryTab = document.getElementById('gallery-tab');
        const tab = new bootstrap.Tab(galleryTab);
        tab.show();
        
        renderImageGallery();
        
        // Auto-select the newly uploaded image in gallery mode
        if (window.currentImageType === 'gallery_images') {
            setTimeout(() => {
                const newImageElement = document.querySelector(`.image-container[data-id="${data.id}"]`);
                if (newImageElement) {
                    selectImage(newImageElement, data.url, data.original_name, data.id);
                }
            }, 100);
        }
        
        uploadArea.innerHTML = `
            <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
            <h5>Click to upload an image</h5>
            <p class="text-muted">or drag and drop your file here</p>
            <small class="text-muted">(JPEG, PNG, GIF, WEBP, AVIF - Max 4MB)</small>
        `;
        
        initDragAndDrop();
    })
    .catch(error => {
        console.error('Error uploading image:', error);
        alert('Error uploading image: ' + error.message);
        
        uploadArea.innerHTML = `
            <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
            <h5>Click to upload an image</h5>
            <p class="text-muted">or drag and drop your file here</p>
            <small class="text-muted">(JPEG, PNG, GIF, WEBP, AVIF - Max 4MB)</small>
        `;
        
        initDragAndDrop();
    });
}

function renderImageGallery() {
    const gallery = document.getElementById('imageGallery');
    
    if (window.images.length === 0) {
        gallery.innerHTML = `
            <div class="col-12 text-center py-4">
                <i class="fas fa-image fa-3x text-muted mb-3"></i>
                <p class="text-muted">No images found. Upload some images to get started.</p>
            </div>
        `;
        return;
    }
    
    gallery.innerHTML = '';
    
    window.images.forEach(image => {
        const col = document.createElement('div');
        col.classList.add('col-md-3', 'mb-3');
        
        col.innerHTML = `
            <div class="image-container" data-id="${image.id}" 
                 onclick="selectImage(this, '${image.url}', '${image.original_name}', ${image.id})">
                <img src="${image.url}" 
                    alt="${image.original_name}"
                    class="img-fluid">
                <div class="checkmark">
                    <i class="fas fa-check"></i>
                </div>
                <div class="overlay">
                    <button type="button" class="btn btn-danger btn-sm" onclick="event.stopPropagation(); deleteImage(${image.id}, this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
        
        gallery.appendChild(col);
    });
}

function deleteImage(id, button) {
    if (!confirm('Are you sure you want to delete this image permanently?')) return;
    
    const originalText = button.innerHTML;
    button.disabled = true;
    button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
    
    fetch(`/api/media/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': getCsrfToken(),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => {
                throw new Error(err.error || 'Delete failed');
            });
        }
        return response.json();
    })
    .then(data => {
        window.images = window.images.filter(img => img.id !== id);
        renderImageGallery();
        
        // Remove from gallery selections if selected
        if (window.selectedGalleryImages.has(id)) {
            window.selectedGalleryImages.delete(id);
        }
        
        // Remove from gallery display if exists
        window.removeGalleryImage(id);
        
        alert('Image deleted successfully!');
    })
    .catch(error => {
        console.error('Error deleting image:', error);
        alert('Error deleting image: ' + error.message);
    })
    .finally(() => {
        button.disabled = false;
        button.innerHTML = originalText;
    });
}