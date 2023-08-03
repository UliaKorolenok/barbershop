<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <title>Blade</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

<body class="">

    <nav class="back navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img class="logo" src="{{ asset('images/logo1.png')}} ">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item mx-3 mr-2">
                        <a class="nav-link" href="{{ route('services') }}">Услуги</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="{{ route('masters') }}">Мастера</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="{{ route('cosmetics') }}">Товары</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="{{ route('reviews') }}">Отзывы</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="{{ route('contacts') }}">Контакты</a>
                    </li>
                    @guest
                    <li class="nav-item mx-5">
                        <a class='nav-link registr' href="{{ route('login') }}">Вход</a>
                    </li>

                    @else
                    <li class="nav-item ml-4">
                        <a class=' nav-link registr' href="{{ route('register') }}">Профиль</a>
                    </li>
                    <li class="nav-item mr-5">
                        <a class=' nav-link registr' href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Выход
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </a>
                    </li>
                    @endguest
                </ul>

                <div class="f">
                    <form name="search" action="" method="GET" class="searchForm">
                        {{csrf_field()}}
                        <div class="search-container">
                            <input type="search" class="form-control" autocomplete="off" name="query" placeholder="Поиск">
                            <div class="search-result cosmetic"></div>
                        </div>
                    </form>
                </div>


            </div>

        </div>



    </nav>

    @yield('content')

    <footer class="text-center text-lg-start text-white">
        <section>
            <div class="container text-center text-md-start pt-4">

                <div class="row">

                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

                        <p>
                            <a class="navbar-brand" href="/">
                                <img height="70" width="170" class="d-inline-block align-top" src="{{ asset('images/logo1.png')}}">
                            </a>
                        </p>
                    </div>

                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <p>
                            Blade Barbershop — намного больше, чем просто мужская парикмахерская.
                            Это место, где Вам помогут найти свой собственный стиль.
                        </p>
                    </div>

                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <p>
                            Время работы:
                        </p>
                        <p>

                            Пн.- вс. с 10.00 до 21.00
                        </p>
                    </div>

                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-md-0 mb-4">
                        <p>
                            <FontAwesomeIcon icon={faHome} />пр. Независимости, 93
                        </p>
                        <p>
                            <FontAwesomeIcon icon={faEnvelope} />blade@gmail.com
                        </p>
                        <p>
                            <FontAwesomeIcon icon={faPhone} /> +375 44 7301493
                        </p>
                    </div>

                </div>

            </div>
        </section>

        <div class="text-center p-3 copy">© 2023 Copyright: Королёнок Юлия
        </div>

    </footer>

    <script>
        $(window).scroll(function() {
            if ($(document).scrollTop() > 100) {
                $("nav").addClass("animate");
            } else {
                $("nav").removeClass("animate");
            }
        });
        $('input[name="query"]').keyup(function(e) {
            e.preventDefault();
            let query = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{url('search')}}",
                type: 'post',
                data: {
                    query: query,
                },
                success(data) {
                    $('.cosmetic').html(data.message);
                }
            });

        });
    </script>

</body>

</html>