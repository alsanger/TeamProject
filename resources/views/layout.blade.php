<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TEAM PROJECT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Стили для бегущей строки */
        .marquee {
            overflow: hidden;
            white-space: nowrap;
            box-sizing: border-box;
            background: rgba(93, 92, 97, 0.3);
            padding: 2px;
            border-bottom: 2px solid #ccc;
            position: relative;
            height: 40px;
            width: 100%;
            margin-bottom: 0;
        }
        .marquee-content {
            display: flex;
            align-items: center;
            white-space: nowrap;
            padding-left: 100%;
            animation: marquee 35s linear infinite;
            font-family: Apercu, sans-serif;
            font-size: 14px;
            color: #000;
        }
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .marquee img {
            vertical-align: middle;
            margin-right: 2px;
            margin-left: 2px;
            height: 40px;
            width: 40px;
        }

        /* Стили для навигационного меню */
        nav {
            background: #E9E9E9;
            color: #000;
            height: 70px;
            display: flex;
            align-items: center;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .nav-logo {
            margin-right: 15px;
        }
        nav a {
            color: #000;
            text-decoration: none;
            padding: 0 15px;
            font-size: 15px;
            font-weight: bold;
            font-family: Apercu, sans-serif;
            display: inline-block;
            margin: 0;
            line-height: 40px;
            width: 150px;
            text-align: center;
            border-radius: 5px;
            box-sizing: border-box;
        }
        nav a:hover {
            background: #DCDCDC;
            color: #000;
            border-radius: 10px;
        }

        .search-container {
            display: flex;
            align-items: center;
            margin-left: auto;
            padding: 0 15px;
            position: relative;
        }
        .search-container input {
            border: 1px solid #ccc;
            padding: 5px 10px 5px 35px;
            font-size: 10px;
            border-radius: 5px;
            box-sizing: border-box;
            background: #fff;
            width: 300px;
        }
        .search-container img {
            position: absolute;
            left: 10px;
            height: 18px;
            width: 18px;
            margin-left: 10px;
        }

        .layout-container .user-info, .layout-container .actions {
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: flex-end;
            padding: 10px;
            border: none;
        }
    </style>
</head>
<body>

<div class="marquee">
    <div class="marquee-content">
        <img src="{{ asset('images/free-icon-php.png') }}" alt="PHP Icon" width="30" height="30">
        <span>-Welcome to the team project!-</span>
        <img src="{{ asset('images/free-icon-php.png') }}" alt="PHP Icon" width="30" height="30">
        <span>-Welcome to the team project!-</span>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var marqueeContent = document.querySelector('.marquee-content');
        var originalContent = marqueeContent.innerHTML;
        marqueeContent.innerHTML += originalContent;
    });
</script>

<nav>
    <a href="{{ route('home') }}" class="btn btn-primary">Home</a>
    @auth
        <a href="{{ route('user.personalArea') }}" class="btn btn-primary">Personal Area</a>
        <a href="{{ route('position.redirectToPageBasedOnRole') }}" class="btn btn-primary">Work Area</a>
    @endauth

    <div class="search-container">
        <input type="text" placeholder="Search...">
        <img src="{{ asset('images/free-icon-search.png') }}" alt="Search Icon">
    </div>

    <div class="container layout-container">
        @auth
            <div class="user-info">
                <p>Welcome, {{ auth()->user()->first_name }} </p>
                <form method="POST" action="{{ route('user.logoutUser') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </div>
        @else
            <div class="actions">
                <a href="{{ route('user.loginUserGet') }}" class="btn btn-primary">Login</a>
            </div>
        @endauth
    </div>
</nav>

<div id="content">
    @yield('content')
</div>

<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
