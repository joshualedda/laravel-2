<div>
    <section class="p-2">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <table id="myTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email Address</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->getRoleText() }}</td>
                            <td>
                                <a href="{{ url('/updateAccount', ['userId' => $user->id]) }}" type="button" class="btn btn-primary btn-sm rounded-full">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
        // new DataTable('#example');
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
</div>
