<div class="sidebar">
    <div class="sidebar-header p-3">
         @if(isset($setting) && $setting->site_logo)
            <div class="text-center">
                <img src="{{ asset('storage/' . $setting->site_logo) }}" alt="Site Logo" style="max-height: 50px; max-width: 200px;">
            </div>
        @else
            <h4 class="text-center">Print-Ecommerce</h4>
        @endif
        <hr class="text-black">
    </div>
    
    <ul class="nav flex-column">
        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>
        </li>

        <!-- Products Collapse Menu -->
        @php
            $isProductsActive = request()->routeIs('productcategories.*') || request()->routeIs('products.*') || request()->routeIs('product.*');
        @endphp
        
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center {{ $isProductsActive ? 'active' : '' }}" 
               href="#" 
               data-bs-toggle="collapse" 
               data-bs-target="#productsCollapse" 
               aria-expanded="{{ $isProductsActive ? 'true' : 'false' }}"
               aria-controls="productsCollapse">
                <i class="bi bi-box-seam me-2"></i>
                <span class="">Products</span>
                <i class="bi bi-chevron-down ms-auto collapse-icon"></i>
            </a>
            <div class="collapse {{ $isProductsActive ? 'show' : '' }}" id="productsCollapse">
                <ul class="nav flex-column ps-4">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.index') ? 'active' : '' }}" href="{{ route('products.index') }}">
                            <i class="bi bi-grid me-2"></i>All Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.create') ? 'active' : '' }}" href="{{ route('products.create') }}">
                            <i class="bi bi-plus-circle me-2"></i>Add new product
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('productcategories.index') ? 'active' : '' }}" href="{{ route('productcategories.index') }}">
                            <i class="bi bi-tags me-2"></i>Product Categories
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- blogs Collapse Menu -->
        @php
            $isBlogsActive = request()->routeIs('blogcategories.*') || request()->routeIs('blogs.*') || request()->routeIs('blog.*');
        @endphp
        
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center {{ $isBlogsActive ? 'active' : '' }}" 
               href="#" 
               data-bs-toggle="collapse" 
               data-bs-target="#blogsCollapse" 
               aria-expanded="{{ $isBlogsActive ? 'true' : 'false' }}"
               aria-controls="blogsCollapse">
                <i class="bi bi-box-seam me-2"></i>
                <span class="">Blogs</span>
                <i class="bi bi-chevron-down ms-auto collapse-icon"></i>
            </a>
            <div class="collapse {{ $isBlogsActive ? 'show' : '' }}" id="blogsCollapse">
                <ul class="nav flex-column ps-4">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('blogs.index') ? 'active' : '' }}" href="{{ route('blogs.index') }}">
                            <i class="bi bi-grid me-2"></i>All Blogs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('blogs.create') ? 'active' : '' }}" href="{{ route('blogs.create') }}">
                            <i class="bi bi-plus-circle me-2"></i>Add new blogs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('blogcategories.index') ? 'active' : '' }}" href="{{ route('blogcategories.index') }}">
                            <i class="bi bi-tags me-2"></i>Blogs Categories
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Orders -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('orders') ? 'active' : '' }}" href="{{ route('orders') }}">
                <i class="bi bi-cart-check me-2"></i>
                Orders
            </a>
        </li>

        <!-- Settings -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard.settings*') ? 'active' : '' }}" href="{{ route('dashboard.settings.index') }}">
               <i class="bi bi-gear me-2"></i>
                Settings
            </a>
        </li>

        <!-- Logout -->
        <li class="nav-item mt-3">
            <form method="POST" class="nav-link" action="{{ route('logout') }}" class="w-100">
                @csrf
                <button type="submit" class=" border-0 bg-transparent   ">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </button>
            </form>
        </li>
    </ul>
</div>