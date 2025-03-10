<div class="container mt-4">
    <h4 class="text-center main-heading">Managers</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    @if (Auth::user()->role == 'super_admin')
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @if ($managers->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">No Manager available.</td>
                </tr>
                @else

                @foreach ($managers as $manager )
                <tr>
                    <td><span>{{ $manager->name }}</span></td>
                    <td><span>{{ $manager->email }}</span></td>
                    <td><span>{{ $manager->phone }}</span></td>
                    @if (Auth::user()->role =='super_admin')
                    
                    <td>
                        <a href="{{ route('user.edit', $manager->id) }}" class="btn btn-sm text-white bg-warning">Update</a>
                        <form action="{{ route('delete.user',$manager->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm text-white bg-danger">Delete</button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>