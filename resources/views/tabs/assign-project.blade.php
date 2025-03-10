<div class="container mt-4">
    <h4 class="text-center main-heading">Assign Projects</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Description</th>
                    <th>Users</th>
                    <th>Status</th>
                    @if (Auth::user()->role == 'manager')
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @if ( Auth::user()->role === 'manager' )
                    @if ($user_assign_projects->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No assigned projects available.</td>
                        </tr>
                    @else
                        @foreach ($user_assign_projects as $project)
                            <tr>
                                <td>{{ $project->name }}</td>
                                <td>{{ $project->description }}</td>
                                <td> 
                                @foreach ($project->users as $user )
                                    <span>{{ $user->name }}</span> | 
                                    @endforeach
                                </td>

                                <td><span class="badge bg-info">{{ $project->status }}</span></td>
                                    <td>
                                        <a href="{{ route('project.accept', $project->id) }}" class="btn btn-sm text-white bg-warning">Accept</a>
                                    </td>
                            </tr>
                        @endforeach
                    @endif
                @else
                    @if ($all_assign_projects->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No assigned projects available.</td>
                        </tr>
                    @else
                        @foreach ($all_assign_projects as $project)
                            <tr>
                                <td>{{ $project->name }}</td>
                                <td>{{ $project->description }}</td>
                                <td> 
                                @foreach ($project->users as $user )
                                    <span>{{ $user->name }}</span> | 
                                    @endforeach
                                </td>
                                <td><span class="badge bg-info">{{ $project->status }}</span></td>
                            </tr>
                        @endforeach
                    @endif
                @endif
            </tbody>
        </table>
    </div>
</div>
