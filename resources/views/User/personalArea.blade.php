@extends('layout')

@section('content')
    <label>PERSONAL AREA</label>
    @auth
        <div class="user-info">
            <p>Welcome, {{ auth()->user()->first_name }} (ID: {{ auth()->user()->id }})</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Back to home page</a>
            <form method="post" action="{{ route('user.editUser') }}" style="display:inline;">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />
                <input type="hidden" name="redirect_url" value="{{ route('user.personalArea') }}">
                <button type="submit" class="btn btn-warning">Edit</button>
            </form>
            <form method="POST" action="{{ route('user.logoutUser') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
            <h2>Available vacancies:</h2>
            <ul>
                @foreach ($positions as $position)
                    <li>
                        {{ $position->name }} (Salary: {{ $position->salary }})
                        <form method="GET" action="{{ route('position.showDetails', $position->id) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-info btn-sm">More Details</button>
                        </form>
                    </li>
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
@endsection
