@auth
    @if($roles->contains('administrator'))
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
             <a href="{{ route('position.createRoleGet') }}" class="btn btn-success">Create Role</a>
            <a href="{{ route('position.createKnowledgeGet') }}" class="btn btn-success">Create Knowledge</a>

            <h2>ALL POSITIONS:</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Department Name</th>
                        <th>Salary</th>
                        <th>Description</th>
                        <th>Is Vacancy</th>
                        <th>Roles</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($positions as $position)
                    <tr>
                        <td>{{ $position->id }}</td>
                        <td>{{ $position->name }}</td>
                        <td>{{ $position->department ? $position->department->name : 'N/A' }}</td>
                        <td>{{ $position->salary }}</td>
                        <td>{{ $position->description }}</td>
                        <td>{{ $position->is_vacancy ? 'Yes' : 'No' }}</td>
                        <td>{!! nl2br(e($position->roles_list)) !!}</td>
                        <td>
{{--                            <form method="post" action="{{ route('workArea.administratorUpdatePosition', $position->id) }}" style="display:inline;">--}}
                            <form style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $position->position_id }}" />
                                <button type="submit" class="btn btn-warning">Edit</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <br><a href="{{ route('workArea.HR_manager') }}" class="btn btn-success">HR Manager Work Area</a>

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
                        <td>
                            {{ $user->position_name }}
                            @if(!is_null($user->department_name))
                                (Department: {{ $user->department_name }})
                            @endif
                        </td>
                        <td>{{ $user->status_name }}</td>
                        <td>
{{--                            <form method="post" action="{{ route('workArea.administratorUpdateUser', $user->user_id) }}" style="display:inline;">--}}
                            <form style="display:inline;">
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
    @endif
@endauth
