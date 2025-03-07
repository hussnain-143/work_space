@extends('layout')

@section('title', 'Profile')

@section('main-content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0 glassmorphism">
                    <div class="card-header my-bg-dark text-white text-center">
                        <h4><i class="bi bi-user"></i>Hi ! {{ Auth::user()->name }}  </h4>
                    </div>
                    <div class="card-body">
                    <div class="container mt-4 d-flex justify-content-center">
    <!-- User Profile Card -->
    <div class="card shadow-lg border-0 p-4 text-center profile-card">
        <div class="d-flex justify-content-center">
            <img src="{{ Auth::user()->profile_image ?? asset('images/default-user.png') }}" 
                alt="Profile Image" 
                class="rounded-circle shadow-lg profile-img">
        </div>
        <h4 class="mt-3 main-heading">{{ Auth::user()->name }}</h4>
        <p class="text-muted fs-5">{{ Auth::user()->email }}</p>

        <div class="mt-3 profile-details">
            <p><i class="bi bi-telephone-fill text-info"></i> <strong>Phone:</strong> {{ Auth::user()->phone ?? 'Not Provided' }}</p>
            <p><i class="bi bi-briefcase-fill text-warning"></i> <strong>Position:</strong> {{ ucfirst(Auth::user()->role) }}</p>
        </div>
        <a href="{{ route('user.edit', Auth::user()->id) }}" class="btn btn-color text-white">Update</a>
    </div>
</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
