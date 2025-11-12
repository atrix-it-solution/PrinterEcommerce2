<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Dashboard</title>
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/font-awesome-all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/style.css') }}" />
</head>
<body>
    <!-- Sidebar -->
    @include('layouts.dashboard.sidebar')

    <!-- Top Navbar -->
    @include('layouts.dashboard.header')

    <!-- Main Content -->
    <main class="main-content">
        @yield('dashboard-content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    
    <script src="{{ asset('assets/dashboard/js/custom.js')}}"></script>
    <script src="{{ asset('assets/dashboard/js/media.js')}}"></script>
    

</body>
</html>