<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Manager Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      
      
        .image-container {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid #ddd;
        }
        .image-container img {
            width: 100%;
            height: 130px;
            object-fit: cover;
            border: 5px solid transparent;
            transition: all 0.3s ease;
        }
        .image-container.selected img {
            border-color: var(--theme);
            box-shadow: 0 5px 15px rgba(108, 92, 231, 0.4);
        }
        .image-container .checkmark {
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--theme);
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .image-container.selected .checkmark {
            opacity: 1;
        }
        .image-container .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .image-container:hover .overlay {
            opacity: 1;
        }
     
        .frontend-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .frontend-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .frontend-item img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
        .frontend-item .btn-remove {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .nav-tabs .nav-link.active {
            background-color: var(--theme);
            color: white;
            border: none;
        }
        .nav-tabs .nav-link {
            font-weight: 600;
            color: black;
        }
        .alert {
            display: none;
        }
        .upload-area {
            border: 2px dashed #ccc;
            padding: 30px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .upload-area:hover {
            border-color: var(--theme);
            background-color: #f0f0ff;
        }
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
        }
        .modal-content {
            border-radius: 12px;
            overflow: hidden;
        }
        /* .preview-container {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            text-align: center;
        } */
        #selectedImagePreview {
            max-height: 150px;
            border-radius: 8px;
            border: 2px solid var(--theme);
            display: none;
        }
        .featured-image-preview {
            text-align: center;
            margin-top: 20px;
        }
        .featured-image-preview img {
            max-height: 200px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        #uploadPreview{
            display: none;
        }
        
        @media (min-width: 1200px) {
            .modal-xl
        
        {
                --bs-modal-width: 1525px !important;
            }
        }
    </style>
</head>
<body>
    <div class="container">
      
        <!-- Alert messages -->
        <!-- <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
            <strong>Success!</strong> <span id="successMessage"></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> -->
        
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorAlert">
            <strong>Error!</strong> <span id="errorMessage"></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <!-- Bootstrap Modal -->
        <div class="modal fade" id="uploadImageModal" tabindex="-1" aria-labelledby="uploadImageModalLabel" aria-hidden="true" data-bs-backdrop="static" >
            <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadImageModalLabel"><i class="fas fa-image me-2"></i> Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Add CSRF token meta tag for AJAX requests -->
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        
                        <!-- Nav Tabs -->
                        <ul class="nav nav-tabs" id="imageTab" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active" id="upload-tab" data-bs-toggle="tab" data-bs-target="#upload" type="button" role="tab">
                                    <i class="fas fa-upload me-2"></i>Upload Image
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="gallery-tab" data-bs-toggle="tab" data-bs-target="#display" type="button" role="tab">
                                    <i class="fas fa-th me-2"></i>Media Library
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content mt-4">
                            <!-- Upload Tab -->
                            <div class="tab-pane fade show active" id="upload" role="tabpanel">
                                <div class="upload-area" onclick="document.getElementById('imageInput').click()">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                    <h5>Click to upload an image</h5>
                                    <p class="text-muted">or drag and drop your file here</p>
                                    <small class="text-muted">(JPEG, PNG, GIF, WEBP - Max 4MB)</small>
                                </div>
                                
                                <input type="file" class="d-none" name="image" id="imageInput" accept="image/*" onchange="handleImageUpload(event)">
                                    
                                <div class="text-center mb-4">
                                    <img id="uploadPreview" src="" class="img-fluid rounded" style="max-height:200px; display:none;">
                                </div>
                            </div>

                            <!-- Display Tab -->
                            <div class="tab-pane fade" id="display" role="tabpanel">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5>Media Library</h5>
                                    <!-- <button class="btn btn-outline-primary btn-sm" onclick="loadImages()">
                                        <i class="fas fa-sync-alt me-1"></i>Refresh
                                    </button> -->
                                </div>
                                
                                <div class="row" id="imageGallery">
                                    <div class="col-12 text-center py-4">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <p class="mt-2">Loading images...</p>
                                    </div>
                                </div>

                                <div class="preview-container">
                                    <!-- <h6>Selected Image Preview</h6> -->
                                    <!-- <img id="selectedImagePreview" src="" class="img-fluid rounded mt-3"> -->
                                      <!-- <img id="selectedImagePreview" src="" class="img-fluid rounded mt-3" style="max-height:150px; display:none;"> -->
                                    <div class="mt-3">
                                        <button type="button" class=" mediabtn mt-2" onclick="setAsMediaImage()" aria-label="Set selected image as featured image">
                                            <i class="fas fa-check me-2" aria-hidden="true"></i>Set as Image
                                        </button>
                                    </div>
                                </div>

                                 <input type="hidden" name="image" id="MediaImageInput">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
</body>
</html>