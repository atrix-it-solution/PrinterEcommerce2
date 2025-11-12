@extends('layouts.dashboard.master')

@section('title', 'Dashboard Settings')

@section('dashboard-content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Site Settings</h1>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show auto-dismiss" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('dashboard.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="site_title" class="form-label">Site Title</label>
                            <input type="text" class="form-control" id="site_title" name="site_title" 
                                   value="{{ old('site_title', $setting->site_title ?? '') }}" placeholder="Enter site title">
                            <div class="form-text">This will appear in browser tabs and as the site name.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="contact_email" class="form-label">Contact Email</label>
                            <input type="email" class="form-control" id="contact_email" name="contact_email" 
                                   value="{{ old('contact_email', $setting->contact_email ?? '') }}" placeholder="Enter contact email">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="contact_phone" class="form-label">Contact Phone</label>
                            <input type="text" class="form-control" id="contact_phone" name="contact_phone" 
                                   value="{{ old('contact_phone', $setting->contact_phone ?? '') }}" placeholder="Enter contact phone">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="2" placeholder="Enter company address">{{ old('address', $setting->address ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                 <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Site Icon</label>
                            <div>
                                <button type="button" class="setMediaBtn" data-bs-toggle="modal" data-bs-target="#uploadImageModal" 
                                        onclick="setImageType('site_icon')">
                                    Set Site Icon
                                </button>
                            </div>
                            <!-- Site Icon preview -->
                            <div id="siteIconContainer" style="{{ isset($setting) && $setting->site_icon ? '' : 'display:none;' }} margin-top:10px;">
                                <div class="frontend-item d-inline-block position-relative">
                                    <img id="siteIconImage" src="{{ isset($setting) && $setting->site_icon ? asset('storage/' . $setting->site_icon) : '' }}" 
                                         class="img-fluid rounded border" style="max-height:100px;">
                                    <button type="button" class="btn btn-danger btn-sm btn-remove position-absolute top-0 end-0 m-1"
                                            onclick="removeImage('site_icon')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="site_icon" id="siteIconInput" value="{{ old('site_icon', $setting->site_icon ?? '') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Site Logo</label>
                            <div>
                                <button type="button" class="setMediaBtn" data-bs-toggle="modal" data-bs-target="#uploadImageModal" 
                                        onclick="setImageType('site_logo')">
                                    Set Site Logo
                                </button>
                            </div>
                            <!-- Site Logo preview -->
                            <div id="siteLogoContainer" style="{{ isset($setting) && $setting->site_logo ? '' : 'display:none;' }} margin-top:10px;">
                                <div class="frontend-item d-inline-block position-relative">
                                    <img id="siteLogoImage" src="{{ isset($setting) && $setting->site_logo ? asset('storage/' . $setting->site_logo) : '' }}" 
                                         class="img-fluid rounded border" style="max-height:100px;">
                                    <button type="button" class="btn btn-danger btn-sm btn-remove position-absolute top-0 end-0 m-1"
                                            onclick="removeImage('site_logo')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="site_logo" id="siteLogoInput" value="{{ old('site_logo', $setting->site_logo ?? '') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Footer Logo</label>
                            <div>
                                <button type="button" class="setMediaBtn" data-bs-toggle="modal" data-bs-target="#uploadImageModal" 
                                        onclick="setImageType('site_footer_logo')">
                                    Set Footer Logo
                                </button>
                            </div>
                            <!-- Footer Logo preview -->
                            <div id="footerLogoContainer" style="{{ isset($setting) && $setting->site_footer_logo ? '' : 'display:none;' }} margin-top:10px;">
                                <div class="frontend-item d-inline-block position-relative">
                                    <img id="footerLogoImage" src="{{ isset($setting) && $setting->site_footer_logo ? asset('storage/' . $setting->site_footer_logo) : '' }}" 
                                         class="img-fluid rounded border" style="max-height:100px;">
                                    <button type="button" class="btn btn-danger btn-sm btn-remove position-absolute top-0 end-0 m-1"
                                            onclick="removeImage('site_footer_logo')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="site_footer_logo" id="footerLogoInput" value="{{ old('site_footer_logo', $setting->site_footer_logo ?? '') }}">
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Save Settings</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                </div>

                @include('pages.dashboard.common.media.index')
            </form>
        </div>
    </div>
</div>


@endsection