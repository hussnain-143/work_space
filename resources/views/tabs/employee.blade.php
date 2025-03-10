<div class="container mt-4">
    <h4 class="text-center main-heading">Employee</h4>
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
                @if ($employees->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">No Employee available.</td>
                </tr>
                @else
                @foreach ($employees as $employee )
                
                <tr>

                    <td><span>{{ $employee->name }}</span></td>
                    <td><span>{{ $employee->email }}</span></td>
                    <td><span>{{ $employee->phone }}</span></td>
                    @if (Auth::user()->role =='super_admin')
                    
                    <td>
                        <a href="{{ route('user.edit' , $employee->id) }}" class="btn btn-sm text-white bg-warning">Update</a>
                        <form action="{{ route('delete.user' , $employee->id) }}" method="POST" style="display:inline;">
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