<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TEAM PROJECT</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .layout-container .user-info, .layout-container .actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>
<body>
<div class="container layout-container">
    @auth
        <div class="user-info">
            <p>Welcome, {{ auth()->user()->first_name }} (ID: {{ auth()->user()->id }})</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Back to home page</a>
            <a href="{{ route('user.personalArea') }}" class="btn btn-primary">Personal Area</a>
            <a href="{{ route('position.redirectToPageBasedOnRole') }}" class="btn btn-primary">Work Area</a>
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
</div>
<hr>
<div id="content">
    @yield('content')
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
