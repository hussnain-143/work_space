@extends('layout')

@section('title', 'Users')

@section('main-content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0 glassmorphism">
                    <div class="card-header my-bg-dark text-white text-center">
                        <h4><i class="bi bi-users"></i> Users</h4>
                    </div>
                    <div class="card-body">
                        <!-- Tabs Navigation -->
                        <ul class="nav nav-tabs" id="projectTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active text-white bg-info" id="manager-tab" data-bs-toggle="tab" data-bs-target="#manager" type="button" role="tab">Manager</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-white bg-primary" id="employee-tab" data-bs-toggle="tab" data-bs-target="#employee" type="button" role="tab">Employee</button>
                            </li>
                        </ul>

                        <!-- Tabs Content -->
                        <div class="tab-content mt-4" id="projectTabsContent">
                            <div class="tab-pane fade show active" id="manager" role="tabpanel">
                                @include('tabs.manager')
                            </div>
                            <div class="tab-pane fade" id="employee" role="tabpanel">
                                @include('tabs.employee')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
