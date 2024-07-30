{{--@extends('layout')--}}

{{--@section('content')--}}
    <label>TeamProject</label>
    <div class="container">
        @auth
            <div class="user-info">
                <p>Welcome, {{ auth()->user()->first_name }} (ID: {{ auth()->user()->id }})</p>
                <a href="{{ route('user.personalArea') }}" class="btn btn-primary">Personal Area</a>
{{--                <a href="{{ route('position.workArea') }}" class="btn btn-primary">Work Area</a>--}}
                <a href="{{ route('position.redirectToPageBasedOnRole', ['id' => auth()->user()->id]) }}" class="btn btn-primary">Work Area</a>
                <form method="POST" action="{{ route('user.logoutUser') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>

            </div>
        @else
            <div class="actions">
                <a href="{{ route('user.loginUserGet') }}" class="btn btn-primary">Login</a>
                <a href="{{ route('user.createUserGet') }}" class="btn btn-secondary">Create New User</a>
            </div>
        @endauth


        <div class="user-list">
            <h2>All Users:</h2>
            <ul>
                @foreach ($users as $user)
                    <li>{{ $user->first_name }} {{ $user->last_name }} (ID: {{ $user->id }})</li>
                @endforeach
            </ul>
        </div>
    </div>
{{--@endsection--}}
