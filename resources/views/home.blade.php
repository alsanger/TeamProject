@extends('layout')

@section('content')
    <div class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Ласкаво просимо на наш сайт з підбору вакансій!</h1>
            <p class="hero-description">Знайдіть свою ідеальну роботу за декілька кліків. Наш сайт пропонує широкий вибір вакансій у різних галузях, щоб ви могли знайти те, що вам підходить.</p>
            <a href="{{ route('user.createUserGet') }}" class="btn btn-start">Почати</a>
        </div>
    </div>
    <div class="features">
        <h2>Наші Переваги</h2>
        <div class="feature-item">
            <h3>Широкий вибір вакансій</h3>
            <p>Ми пропонуємо вакансії в різних сферах діяльності, що дозволяє знайти роботу мрії.</p>
        </div>
        <div class="feature-item">
            <h3>Зручний інтерфейс</h3>
            <p>Наш сайт легко використовувати, і ви можете швидко знайти те, що шукаєте.</p>
        </div>
        <div class="feature-item">
            <h3>Підтримка користувачів</h3>
            <p>Наша команда завжди готова допомогти вам у разі виникнення будь-яких питань.</p>
        </div>
    </div>
@endsection
