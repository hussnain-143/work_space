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
                <tr>
                    <td><span>Name</span></td>
                    <td><span>emal@g.c</span></td>
                    <td><span>1289</span></td>
                    <td>
                        <a href="" class="btn btn-sm text-white bg-warning">Update</a>
                        <form action="" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm text-white bg-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td><span>Name</span></td>
                    <td><span>emal@g.c</span></td>
                    <td><span>1289</span></td>
                    <td>
                        <a href="" class="btn btn-sm text-white bg-warning">Update</a>
                        <form action="" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm text-white bg-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="text-center">No Manager available.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>