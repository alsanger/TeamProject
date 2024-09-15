{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <title>TEAM PROJECT</title>--}}
{{--    <link rel="stylesheet" href="{{ asset('css/style.css') }}">--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="container layout-container">--}}
{{--    @auth--}}
{{--        <div class="user-info">--}}
{{--            <p>Welcome, {{ auth()->user()->first_name }} (ID: {{ auth()->user()->id }})</p>--}}
{{--        </div>--}}
{{--        <div class="actions">--}}
{{--            <a href="{{ route('home') }}" class="btn btn-primary">Home</a>--}}
{{--            <a href="{{ route('user.personalArea') }}" class="btn btn-primary">Vacancy</a>--}}
{{--            <a href="{{ route('position.redirectToPageBasedOnRole') }}" class="btn btn-primary">Work Area</a>--}}
{{--            <button type="button" onclick="location.href='{{ route('user.editUser') }}'" class="btn btn-primary">Edit personal data</button>--}}
{{--            <button type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-primary">Logout</button>--}}
{{--            <form id="logout-form" method="POST" action="{{ route('user.logoutUser') }}" style="display: none;">--}}
{{--                @csrf--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    @else--}}
{{--        <div class="actions">--}}
{{--            <a href="{{ route('user.loginUserGet') }}" class="btn btn-primary">Login</a>--}}
{{--            <a href="{{ route('user.createUserGet') }}" class="btn btn-secondary">Create New User</a>--}}
{{--            <a href="{{ route('user.personalArea') }}" class="btn btn-primary">Vacancy</a>--}}
{{--        </div>--}}
{{--    @endauth--}}
{{--</div>--}}
{{--<hr>--}}
{{--<div id="content">--}}
{{--    @yield('content')--}}
{{--</div>--}}

{{--<script src="{{ asset('js/app.js') }}"></script>--}}
{{--</body>--}}
{{--</html>--}}

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TEAM PROJECT</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
</head>
<body>
<div class="container layout-container">
    @auth
        <div class="user-info">
            <p>Welcome, {{ auth()->user()->first_name }} (ID: {{ auth()->user()->id }})</p>
        </div>
        <div class="actions">
            <a href="{{ route('home') }}" class="btn btn-primary">Home</a>
            <a href="{{ route('user.personalArea') }}" class="btn btn-primary">Vacancy</a>
            <a href="{{ route('position.redirectToPageBasedOnRole') }}" class="btn btn-primary">Work Area</a>
            <form method="post" action="{{ route('user.editUser') }}" style="display:inline;">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />
                <input type="hidden" name="redirect_url" value="{{ route('user.personalArea') }}">
                <button type="submit" class="btn btn-primary">Edit personal data</button>
            </form>
            <form method="POST" action="{{ route('user.logoutUser') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-primary">Logout</button>
            </form>
        </div>
    @else
        <div class="actions"></div>
        <div class="actions">
            <a href="{{ route('home') }}" class="btn btn-primary">Home</a>
            <a href="{{ route('user.loginUserGet') }}" class="btn btn-secondary">Login</a>
            <a href="{{ route('user.createUserGet') }}" class="btn btn-primary">Create New User</a>
            <a href="{{ route('user.personalArea') }}" class="btn btn-primary">Vacancy</a>
        </div>
    @endauth
</div>
<div id="content">
    @yield('content')
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
