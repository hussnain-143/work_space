<div class="container mt-4">
    <h4 class="text-center main-heading">Complete Projects</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead >
                <tr>
                    <th>Project Name</th>
                    <th>Description</th>
                    <th>Users</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @if ( $complete_projects->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">No Complete projects available.</td>
                    </tr>
                @else
                    @foreach ( $complete_projects as $complete)
                    <tr>
                        <td><span >{{ $complete->name }}</span></td>
                        <td><span >{{ $complete->description }}</span></td>
                        <td> 
                                @foreach ($complete->users as $user )
                                    <span>{{ $user->name }}</span> | 
                                    @endforeach
                                </td>
                        <td><span class="badge bg-success">{{ $complete->status }}</span></td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
