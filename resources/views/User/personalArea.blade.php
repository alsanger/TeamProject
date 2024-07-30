<label>PERSONAL AREA</label>
@auth
    <div class="user-info">
        <p>Welcome, {{ auth()->user()->first_name }} (ID: {{ auth()->user()->id }})</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Back to home page</a>
        <form method="POST" action="{{ route('user.logoutUser') }}" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
        <h2>Available vacancies:</h2>
        <ul>
            @foreach ($positions as $position)
                <li>{{ $position->name }} (Salary: {{ $position->salary }})</li>
            @endforeach
        </ul>
    </div>
@else
    <div class="actions">
        <p>This page is only available to authorized users</p>
        <a href="{{ route('user.loginUserGet') }}" class="btn btn-primary">Login</a>
        <a href="{{ route('user.createUserGet') }}" class="btn btn-secondary">Create New User</a>
    </div>
@endauth
