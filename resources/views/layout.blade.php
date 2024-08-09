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
    <nav class="nav container">
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


<!--==================== LOGIN ====================-->
<!-- Блок для форми входу -->
<div class="login" id="login">
    <form method="post" action="{{ route('user.loginUserPost') }}" class="login__form">
        @csrf
        <h2 class="login__title">Log In</h2>
        <div class="login__group">
            <div>
                <label for="login" class="login__label">Login</label>
                <input type="text" name="login" value="{{ old('login') }}" id="email" placeholder="Enter your login" class="login__input" required />
            </div>
            @if ($errors->has('login'))
                <label class="errorSpan">{{ $errors->first('login') }}</label>
            @endif
            <div>
                <label for="password" class="login__label">Password</label>
                <input type="password" name="password" placeholder="Enter your password" id="password" class="login__input" required />
            </div>
        </div>
        @if ($errors->has('password'))
            <label class="errorSpan">{{ $errors->first('password') }}</label>
        @endif
        <div class="rememberCheck">
            <label><input type="checkbox"> Remember me</label>
        </div>
        <div>
            <p class="login__signup">
                You do not have an account? <a href="{{ route('user.createUserGet') }}">Sign up</a>
            </p>
            <a href="#" class="login__forgot">
                You forgot your password
            </a>
            <button type="submit" class="login__button">Log In</button>
        </div>
    </form>
    <i class="ri-close-line login__close" id="login-close"></i>
</div>


<script>
    // Відкриття форми входу
    document.getElementById('login-btn').addEventListener('click', function() {
        document.getElementById('login').classList.add('show-login');
    });

    // Закриття форми входу
    document.getElementById('login-close').addEventListener('click', function() {
        document.getElementById('login').classList.remove('show-login');
    });
</script>

<!-- Підключення JavaScript файлу -->
<script src="{{ asset('js/script_home.js') }}"></script>


<!-- Контент, що буде вставлятися з інших шаблонів -->
<div id="content">
    @yield('content')
</div>



</body>
</html>
