@extends('layout')

@section('content')
    <!-- Контейнер для заголовка и изображения -->
    <div class="image-container">
        <h3>
            <span class="itstep">ITSTEP</span><br>
            <span class="academy">Academy</span>
        </h3>
        <img src="{{ asset('images/businesspeopl.png') }}" alt="Business People">
    </div>

    <!-- Секция Company -->
    <section id="company" class="section">
        <h2>Company</h2>
        <p>This is the content of the Company page. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </section>

    <!-- Вставляем содержимое из about.blade.php -->
    @include('about')

@endsection

<style>
    :root {
        --font-family: Apercu, sans-serif; /* Шрифт текста */
        --itstep-font-size: 90px; /* Размер шрифта для ITSTEP */
        --academy-font-size: 60px; /* Размер шрифта для Academy */
        --text-color: #333; /* Цвет текста */
        --margin-bottom: 70px; /* Отступ снизу текста */
        --border-width: 50px; /* Толщина рамки */
        --border-color: black; /* Цвет рамки */
        --image-width: 80%; /* Ширина изображения */
        --max-image-width: 1200px; /* Максимальная ширина изображения */
    }

    .image-container {
        text-align: center; /* Выравнивание содержимого контейнера по центру */
        margin: 40px auto; /* Отступ сверху и снизу и центрирование по ширине страницы */
        width: 100%; /* Ширина контейнера на всю ширину страницы */
        max-width: var(--max-image-width); /* Максимальная ширина контейнера */
    }

    .image-container h3 {
        margin-bottom: var(--margin-bottom); /* Отступ снизу текста */
        color: var(--text-color); /* Цвет текста */
        font-family: var(--font-family); /* Шрифт текста */
        font-weight: bold; /* Жирность текста */
        line-height: 1.2; /* Высота строки для лучшего визуального восприятия */
        word-break: break-word; /* Перенос длинных слов */
    }

    /* Стили для ITSTEP */
    .image-container .itstep {
        font-size: var(--itstep-font-size); /* Размер шрифта для ITSTEP */
    }

    /* Стили для Academy */
    .image-container .academy {
        font-size: var(--academy-font-size); /* Размер шрифта для Academy */
    }

    .image-container img {
        max-width: var(--image-width); /* Ширина изображения */
        height: auto; /* Высота изображения автоматически подстраивается */
        border-radius: 8px; /* Скругление углов изображения (по желанию) */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Тень для изображения (по желанию) */
        width: 100%; /* Изображение не выйдет за пределы контейнера */
        max-width: var(--max-image-width); /* Максимальная ширина изображения */
        border: var(--border-width) solid var(--border-color); /* Толщина и цвет рамки */
    }

</style>
