<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TEAM PROJECT</title>
    <!-- Підключення стилів CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
<header class="header" id="header">
    <nav class="nav containerMain">
        <!-- Логотип або посилання на головну сторінку -->
        <a href="#" class="nav__logo">Logo</a>

        <!-- Меню навігації -->
        <div class="nav__menu" id="nav-menu">
            @auth
                <!-- Меню для авторизованих користувачів -->
                <ul class="nav__list">
                    <li class="nav__item">
                        <p>Welcome, {{ auth()->user()->first_name }} (ID: {{ auth()->user()->id }}) </p>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('home') }}" class="nav__link">Back to home page</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('user.personalArea') }}" class="nav__link">Personal Area</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('position.redirectToPageBasedOnRole') }}" class="nav__link">Work Area</a>
                    </li>
                    <li class="nav__item">
                        <div class="nav__actions">
                            <!-- Кнопка пошуку -->
                            <i class="ri-search-line nav__search" id="search-btn"></i>


                            <!-- Кнопка для відкриття меню -->
                            <div class="nav__toggle" id="nav-toggle">
                                <i class="ri-menu-line"></i>
                            </div>

                            <!-- Форма виходу з системи -->
                            <form method="POST" action="{{ route('user.logoutUser') }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
                            </form>

                        </div>
                    </li>
                </ul>

                <!-- Кнопка закриття меню -->
                <div class="nav__close" id="nav-close">
                    <i class="ri-close-line"></i>
                </div>


            @else
                <!-- Дії для неавторизованих користувачів -->
                <div class="actions">
                    <!-- Кнопка входу -->
                    <i class="ri-user-line nav__login" id="login-btn"></i>
                    <a href="{{ route('user.createUserGet') }}" class="btn btn-secondary">Create New User</a>
                </div>
            @endauth
        </div>
    </nav>
</header>


<!--==================== SEARCH ====================-->
<!-- Блок для пошукового запиту -->
<div class="search" id="search">
    <form action="" class="search__form">
        <i class="ri-search-line search__icon"></i>
        <input type="search" placeholder="What are you looking for?" class="search__input">
    </form>
    <i class="ri-close-line search__close" id="search-close"></i>
</div>




<!-- Підключення JavaScript файлу -->
<script src="{{ asset('js/script_home.js') }}"></script>


<!-- Контент, що буде вставлятися з інших шаблонів -->
<div id="content">
    @yield('content')
</div>



</body>
</html>
