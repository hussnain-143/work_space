@extends('layout')

@section('title', 'Projects')

@section('main-content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0 glassmorphism">
                    <div class="card-header my-bg-dark text-white text-center">
                        <h4><i class="bi bi-kanban"></i> Projects</h4>
                    </div>
                    <div class="card-body">
                        <!-- Tabs Navigation -->
                        <ul class="nav nav-tabs" id="projectTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active text-white bg-danger" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab">Pending</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-white bg-info" id="assign-tab" data-bs-toggle="tab" data-bs-target="#assign" type="button" role="tab">Assign</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-white bg-warning" id="progress-tab" data-bs-toggle="tab" data-bs-target="#progress" type="button" role="tab">Progress</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-white bg-success" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab">Completed</button>
                            </li>
                        </ul>

                        <!-- Tabs Content -->
                        <div class="tab-content mt-4" id="projectTabsContent">
                            <div class="tab-pane fade show active" id="pending" role="tabpanel">
                                @include('tabs.pending-project')
                            </div>
                            <div class="tab-pane fade" id="assign" role="tabpanel">
                                @include('tabs.assign-project')
                            </div>
                            <div class="tab-pane fade" id="progress" role="tabpanel">
                                @include('tabs.progress-project')
                            </div>
                            <div class="tab-pane fade" id="completed" role="tabpanel">
                                @include('tabs.compleate-project')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
