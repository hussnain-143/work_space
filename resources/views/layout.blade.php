<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Work Space | @yield('title')</title>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar d-flex flex-column justify-content-between py-3" id="sidebar">
   <div>
   <h4 class="text-white text-center">Dashboard</h4>
    <a href="#">Home</a>
    <a href="#">Projects</a>
    <a href="#">Users</a>
    <a href="#">Profile</a>
    <a href="#">Logout</a>
   </div>
   <div class="footer text-center py-2 text-white">
       <h5>
           © {{ date('Y') }} Work Space 
       </h5>
   </div>
</div>
</div>

<!-- Topbar with Toggle Button -->
<nav class="navbar navbar-dark my-bg d-md-none d-flex px-3">
    <img src="{{ asset('images/logo.png') }}" alt="" class="logo">
    <button class="btn btn-outline-light ms-3" id="toggleSidebar">☰ Menu</button>
</nav>

<!-- Main Content -->

<div class="content">
    @yield('main-content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
