@extends('index')
@section('nav')
<nav class="back navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img class="logo" src="images/logo1.png">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#">Услуги</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#">О нас</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#">Мастера</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#">
                        Товары
                    </a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#">Контакты</a>
                </li>
            </ul>
        </div>
    </div>
    @guest
    <a class='nav-link registr' href="{{ route('login') }}">{{ __('Авторизация') }}</a>
    @if (Route::has('register'))
    <a class=' nav-link registr' href="{{ route('register') }}">{{ __('Регистрация') }}</a>
    @endif
    @else
    <a class=' nav-link registr ml-5 mr-5' href="{{ route('register') }}">{{ __('Профиль') }}</a>
    <a class='registr ml-5' href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
        {{ __('Выход') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>


    @endguest

    <!-- <a class="nav-link" href="#">+375447301493</a><i class="fa fa-phone" aria-hidden="true"></i>
-->

</nav>

@endsection