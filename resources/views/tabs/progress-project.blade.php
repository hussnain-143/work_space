<div class="container mt-4">
    <h4 class="text-center main-heading">Progress Projects</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead >
                <tr>
                    <th>Project Name</th>
                    <th>Users</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($in_progress_projects->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">No pending projects available.</td>
                    </tr>
                @else
                @foreach ($in_progress_projects as $project)
                <tr>
                        <td><span >{{ $project->name }}</span></td>
                        <td><span >{{ $project->description }}</span></td>
                        <td><span class="badge bg-warning">{{ $project->status }}</span></td>
                        @if (Auth::user()->role == 'employee')
                            @if ($project->status == 'submitted')
                                <td><span class="badge bg-primary">Develop</span></td>
                            @else
                                <td><a href="{{ route('project.submit', $project->id) }}" class="btn btn-sm text-white bg-success">Submit</a></td>
                            @endif
                        @elseif (Auth::user()->role == 'manager' && $project->status == 'submitted')
                        <td><a href="{{ route('project.complete', $project->id) }}" class="btn btn-sm text-white bg-success">Compleate</a></td>
                        @else
                        <td><span class="badge bg-primary">In Development</span></td> 
                        @endif

                    </tr>
                    @endforeach
                @endif
                    
                   
            </tbody>
        </table>
    </div>
</div>
