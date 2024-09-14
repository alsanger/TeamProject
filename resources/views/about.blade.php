<section id="about" class="section">
    <h2>About</h2>
    <p>This is the content of the About page. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

    <!-- Фотогалерея в два ряда -->
    <div class="photo-gallery">
        <div class="photo-gallery-item">
            <img src="{{ asset('images/belouchenko.png') }}" alt="Belouchenko">
            <div class="text">Text for Belouchenko</div>
        </div>
        <div class="photo-gallery-item">
            <img src="{{ asset('images/gordeev.png') }}" alt="Gordeev">
            <div class="text">Text for Gordeev</div>
        </div>
        <div class="photo-gallery-item">
            <img src="{{ asset('images/konstantinov.png') }}" alt="Konstantinov">
            <div class="text">Text for Konstantinov</div>
        </div>
        <div class="photo-gallery-item">
            <img src="{{ asset('images/pisarev.png') }}" alt="Pisarev">
            <div class="text">Text for Pisarev</div>
        </div>
        <div class="photo-gallery-item">
            <img src="{{ asset('images/salagin.png') }}" alt="Salagin">
            <div class="text">Text for Salagin</div>
        </div>
        <div class="photo-gallery-item">
            <img src="{{ asset('images/kovnitska.png') }}" alt="Kovnitska">
            <div class="text">Text for Kovnitska</div>
        </div>
    </div>
</section>

@section('styles')
    <style>
        /* Общие стили для секций */
        .section {
            padding: 20px; /* Отступы внутри секций */
        }

        /* Стили для галереи фотографий */
        .photo-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); /* Адаптивные колонки */
            gap: 20px; /* Расстояние между элементами */
            padding: 0 20px; /* Отступы по бокам */
            margin-top: 20px; /* Отступ сверху */
        }

        .photo-gallery-item {
            display: flex;
            flex-direction: column; /* Выравнивание элементов по вертикали */
            align-items: center; /* Центрирование элементов */
            gap: 10px; /* Расстояние между изображением и текстом */
            border: 2px solid #ccc; /* Рамка контейнера элемента */
            border-radius: 8px; /* Скругление углов контейнера */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Легкая тень для контейнера */
            padding: 10px; /* Отступы внутри элемента */
            background-color: #fff; /* Фоновый цвет контейнера */
        }

        .photo-gallery-item img {
            max-width: 100%; /* Максимальная ширина изображения */
            height: auto; /* Автоматическая высота для сохранения пропорций */
            border-radius: 8px; /* Скругление углов изображения */
            border: 2px solid #ccc; /* Рамка изображения */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Тень для изображения */
        }

        .photo-gallery-item .text {
            font-size: 16px; /* Размер шрифта текста */
            color: #333; /* Цвет текста */
            font-family: Apercu, sans-serif; /* Шрифт текста */
            text-align: center; /* Центрирование текста */
            margin-top: 10px; /* Отступ сверху для текста */
        }
    </style>
@endsection
