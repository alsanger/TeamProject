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
            flex-wrap: wrap; /* Позволяет перенос элементов на новую строку */
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

        /* Стили для кнопки Logout */
        .btn-logout {
            color: #000; /* Цвет текста кнопки */
            text-decoration: none; /* Удаление подчеркивания текста (для ссылки) */
            padding: 0 15px; /* Отступы по горизонтали (справа и слева) */
            font-size: 15px; /* Размер шрифта текста кнопки */
            font-weight: bold; /* Жирное начертание шрифта */
            font-family: Apercu, sans-serif; /* Шрифт текста кнопки */
            display: inline-block; /* Отображение элемента как строчный блок для возможности задания размеров и отступов */
            margin-top: 9px; /* Отступ сверху в 20 пикселей */
            line-height: 40px; /* Высота строки для вертикального центрирования текста внутри кнопки */
            width: 150px; /* Ширина кнопки */
            text-align: center; /* Выравнивание текста по центру кнопки */
            border-radius: 5px; /* Радиус скругления углов кнопки */
            border: none; /* Удаление границы кнопки */
            background-color: #E9E9E9; /* Цвет фона кнопки */
            box-sizing: border-box; /* Включение отступов и границ в общую ширину и высоту элемента */
            height: 40px; /* Пример фиксированной высоты кнопки */
        }

        .btn-logout:hover {
            background: #DCDCDC; /* Цвет фона кнопки при наведении курсора */
            color: #000; /* Цвет текста кнопки при наведении курсора */
            border-radius: 10px; /* Радиус скругления углов кнопки при наведении (чтобы создать эффект визуального изменения) */
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

        .layout-container {
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: flex-end;
            padding: 10px;
            border: none;
            flex-wrap: nowrap; /* Отключение переноса элементов на новую строку */
            margin: 0; /* Удаление внешних отступов */
        }

        /* Стили для приветственного сообщения */
        .welcome-message {
            font-size: 17px; /* Размер шрифта текста приветственного сообщения */
            color: #333; /* Цвет текста (темно-серый) */
            font-family: Apercu, sans-serif; /* Шрифт текста сообщения */
            margin: 2px 2px; /* Отступы сверху и снизу. Можно увеличить для лучшего визуального восприятия */
            text-align: center; /* Выравнивание текста по центру внутри блока */
            display: flex; /* Использование flexbox для выравнивания содержимого по горизонтали и вертикали */
            align-items: center; /* Вертикальное выравнивание элементов внутри блока по центру */
            gap: 5px; /* Расстояние между элементами внутри блока (например, между текстом и кнопкой) */
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
    <a href="#company" class="btn btn-success">Company</a>
    <a href="#about" class="btn btn-secondary">About project</a>
    @auth
        <a href="{{ route('user.personalArea') }}" class="btn btn-primary">Personal Area</a>
        <a href="{{ route('position.redirectToPageBasedOnRole') }}" class="btn btn-primary">Work Area</a>
    @endauth

    <div class="search-container">
        <input type="text" placeholder="Search...">
        <img src="{{ asset('images/free-icon-search.png') }}" alt="Search Icon">
    </div>

    @auth
        <div class="layout-container">
            <div class="welcome-message">
                <p>Welcome, {{ Auth::check() ? Auth::user()->first_name : 'Guest' }}</p>
                <form method="POST" action="{{ route('user.logoutUser') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            </div>
        </div>
    @else
        <div class="actions">
            <a href="{{ route('user.loginUserGet') }}" class="btn btn-primary">Login</a>
        </div>
    @endauth
</nav>

<div id="content">
    @yield('content')
</div>

<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
