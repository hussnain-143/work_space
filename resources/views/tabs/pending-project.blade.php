<div class="container mt-4">
    <h4 class="text-center main-heading">Pending Projects</h4>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    @if(session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
    @endif
    @if(session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    @if (Auth::user()->role == 'super_admin')
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @if ($pending_projects->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center">No pending projects available.</td>
                    </tr>
                @else
                    @foreach ($pending_projects as $project)
                        <tr>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->description }}</td>
                            <td><span class="badge bg-danger">{{ $project->status }}</span></td>
                            @if (Auth::user()->role == 'super_admin')
                                <td>
                                    <a href="#" class="btn btn-sm text-white bg-info assign-btn"
                                       data-bs-toggle="modal" 
                                       data-bs-target="#assignModal" 
                                       data-project-id="{{ $project->id }}"
                                       data-project-name="{{ $project->name }}">
                                       Assign
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="assignModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="assignModalLabel">Assign Project</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Dynamic Project Name -->
                <p><strong>Project: </strong> <span id="selectedProjectName"></span></p>

                <!-- Nav Tabs -->
                <ul class="nav nav-tabs" id="assignTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="manager-tab" data-bs-toggle="tab" data-bs-target="#manager" type="button" role="tab" aria-controls="manager" aria-selected="true">Manager</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="employee-tab" data-bs-toggle="tab" data-bs-target="#employee" type="button" role="tab" aria-controls="employee" aria-selected="false">Employee</button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3" id="assignTabsContent">
                    <!-- Manager Tab -->
                    <div class="tab-pane fade show active" id="manager" role="tabpanel" aria-labelledby="manager-tab">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($managers as $manager)
                                    <tr>
                                        <td>{{ $manager->name }}</td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-sm text-white assign-link" 
                                               data-user-id="{{ $manager->id }}">
                                               Assign
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Employee Tab -->
                    <div class="tab-pane fade" id="employee" role="tabpanel" aria-labelledby="employee-tab">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->name }}</td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-sm text-white assign-link" 
                                                data-user-id="{{ $employee->id }}">
                                                Assign
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to Handle Dynamic Assigning -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let projectId = null;

        // Open modal and set project ID & name dynamically
        document.querySelectorAll(".assign-btn").forEach(button => {
            button.addEventListener("click", function() {
                projectId = this.getAttribute("data-project-id");
                document.getElementById("selectedProjectName").textContent = this.getAttribute("data-project-name");
            });
        });

        // Assign project to manager/employee
        document.querySelectorAll(".assign-link").forEach(link => {
            link.addEventListener("click", function(event) {
                event.preventDefault();
                let userId = this.getAttribute("data-user-id");
                
                if (projectId) {
                    window.location.href = `{{ route('project.assign', ['user_id' => '__USER_ID__', 'project_id' => '__PROJECT_ID__']) }}`
                        .replace('__USER_ID__', userId)
                        .replace('__PROJECT_ID__', projectId);
                }
            });
        });
    });
</script>
