@extends('layout')

@section('title', 'Create Project')

@section('main-content')
<div class="card mx-auto" style="max-width: 600px;">
    <div class="card-header my-bg-dark text-white text-center">
        <h4 class="mb-0">
            <i class="bi bi-folder-plus"></i> <!-- Bootstrap Icon for project -->
            Create New Project
        </h4>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('project.save') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">
                    <i class="bi bi-pencil-square"></i> Project Name
                </label>
                <input type="text" id="name" name="name" class="form-control border @error('name') is-invalid @enderror">
                @error('name') <span class="text-danger"><i class="bi bi-exclamation-triangle-fill"></i> {{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">
                    <i class="bi bi-card-text"></i> Project Description
                </label>
                <textarea id="description" name="description" class="form-control border @error('description') is-invalid @enderror" rows="4"></textarea>
                @error('description') <span class="text-danger"><i class="bi bi-exclamation-triangle-fill"></i> {{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-color text-white w-100">
                <i class="bi bi-send-fill"></i> Create Project
            </button>
        </form>
    </div>
</div>
@endsection
