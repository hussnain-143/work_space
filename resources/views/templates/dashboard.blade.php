@extends('layout')

@section('title', 'Home')

@section('main-content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0 glassmorphism">
                    <div class="card-header my-bg-dark text-white text-center">
                        <h4 ><i class="bi bi-speedometer2"></i> Home</h4>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <!-- Total Projects -->
                            <div class="col-md-6 mb-3">
                                <div class="card card-stats my-bg text-white shadow-glass p-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h5 class="fw-bold">Total Projects</h5>
                                                <h2 class="fw-bolder">{{ $projects }}</h2>
                                            </div>
                                            <i class="bi bi-kanban fa-3x neumorphic-hover"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Total Users -->
                            <div class="col-md-6 mb-3">
                                <div class="card card-stats my-bg-dark text-white shadow-glass p-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h5 class="fw-bold">Total Users</h5>
                                                <h2 class="fw-bolder">{{ $total_user }}</h2>
                                            </div>
                                            <i class="bi bi-people fa-3x neumorphic-hover"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Chart Section -->
                        <div class="mt-5">
                            <h4 class="text-center main-heading">Project Progress</h4>
                            <div class="chart-container d-flex justify-content-center">
                                <canvas id="projectChart" class="p-3"></canvas>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons & Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
    var totalProjects = {{ $projects }};
    var completedProjects = {{ $complete_projects }};
    var pendingProjects = totalProjects - completedProjects;

    var ctx = document.getElementById('projectChart').getContext('2d');
    var projectChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Completed Projects', 'Pending Projects'],
            datasets: [{
                data: [completedProjects, pendingProjects],
                backgroundColor: ['#23A7B3', '#2C4359'], // Accent & Primary color
                borderColor: ['#1C7C86', '#1B2E40'], // Darker shades for contrast
                borderWidth: 2,
                hoverOffset: 8
            }]
        },
        options: {
            maintainAspectRatio: false, // Allow custom width & height
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>

@endsection
