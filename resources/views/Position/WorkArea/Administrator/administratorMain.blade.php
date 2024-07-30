@auth
{{--    @if(in_array('administrator', $roles))--}}
        <div class="user-info">
            <p>Welcome, {{ auth()->user()->first_name }} (ID: {{ auth()->user()->id }})</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Back to home page</a>
            <form method="POST" action="{{ route('user.logoutUser') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
            <br>
            <!-- New buttons for adding entries -->
            <a href="{{ route('position.createPositionGet') }}" class="btn btn-success">Create Position</a>
            <a href="{{ route('position.createDepartmentGet') }}" class="btn btn-success">Create Department</a>
            {{-- <a href="{{ route('position.createRoleGet') }}" class="btn btn-success">Create Role</a> --}}
            <a href="{{ route('position.createKnowledgeGet') }}" class="btn btn-success">Create Knowledge</a>
            {{-- <a href="{{ route('position.createStatusGet') }}" class="btn btn-success">Create Status</a> --}}

            <h2>ALL USERS:</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Login</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Image Link</th>
                    <th>Knowledges</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th>Department</th>
                    <th>Roles</th>
                    <th>Chat Link</th> <!-- Закомментированная ссылка на чат -->
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->user_id }}</td>
                        <td>{{ $user->login }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->image_link }}</td>
                        <td>{!! nl2br(e($user->knowledges)) !!}</td>
                        <td>{{ $user->position_name }}</td>
                        <td>{{ $user->status_name }}</td>
                        <td>{{ $user->department_name }}</td>
                        <td>{!! nl2br(e($user->roles)) !!}</td>
                        <td>ССЫЛКА</td>
                        <td>
                            <form method="post" action="{{ route('workArea.administratorUpdateUser', $user->user_id) }}" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $user->user_id }}" />
                                <button type="submit" class="btn btn-warning">Edit</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="actions">
            <p>This page is only available to administrator authorized users</p>
            <a href="{{ route('user.loginUserGet') }}" class="btn btn-primary">Login</a>
            <a href="{{ route('user.createUserGet') }}" class="btn btn-secondary">Create New User</a>
        </div>
@endauth
