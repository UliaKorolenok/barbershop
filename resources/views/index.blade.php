@extends('layouts.app')
@section('content')

<div class="block-popup">
    <div id="container">
        <form>
            <h1 class='beigeColor'>&bull; Запись на услугу &bull;</h1>
            <div class="underline pt-2 mb-3">
            </div>
            <P class="msg none"></P>
            {{csrf_field()}}
            <div class="row mt-4">
                <div class="col-6">
                    <div class="name">
                        @guest <input type="text" placeholder="Введите имя" name="name" id="name_input" required />
                        @else <input type="text" placeholder="Введите имя" name="name" value="{{Auth::user()->name}}" id="name_input" required />@endguest
                    </div>
                </div>
                <div class="col-6">
                    <div class="email">
                        @guest <input type="text" placeholder="Введите email" name="email" id="email_input" required />
                        @else <input type="text" placeholder="Введите email" value="{{ Auth::user()->email }}" name="email" id="email_input" required />@endguest
                    </div>
                </div>
            </div>
            <div class="phone">
                @guest <input type="tel" placeholder="Введите номер телефона" name="phone" id="phone_input" required />
                @else <input type="tel" placeholder="Введите номер телефона" value="{{ Auth::user()->phone }}" name="phone" id="phone_input" required />@endguest
            </div>
            <div class="subject">
                <select placeholder="Выберите услугу" name="service">
                    <option disabled hidden selected>Выберите услугу</option>
                    @foreach($service as $el)
                    <option value="{{$el->id}}">{{$el->serviceName}} (цена: {{$el->servicePrice}} руб.)</option>
                    @endforeach
                </select>
            </div>
            <div class="subject">
                <select placeholder="Выберите мастера" name="master" id="subject_input" required>
                    <option disabled hidden selected>Выберите мастера</option>
                    @foreach($master as $el)
                    <option value="{{$el->id}}">{{$el->masterFio}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="subject">
                        <input id="customDatePicker" type="text" class="date" name="date" placeholder="Выберите дату" readonly />
                    </div>
                </div>
                <div class="col-6">
                    <div class="subject">
                        <select placeholder="Выберите время" name="time" id="subject_input" required>
                            <option disabled hidden selected>Выберите время</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="submit text-center mt-4 mb-0">
                <input class="btnSignUp" type="submit" value="Записаться" id="form_button" />
            </div>
        </form>
        <span>&times;</span>
        <p class="id">
            @if (Route::has('register')) 0 @else {{ Auth::user()->id }} @endif
        </p>
    </div>
</div>
<div class="overlay"></div>
<div class="background">
    <div class="background2">
        @yield('nav')
        <div class="container">
            <div class="mainTitle">
                <div class="row">
                    <h1 class="display-1 textEffect">Подберём ваш</h1>
                </div>
                <div class="row">
                    <h1 class="display-1 textEffect">индивидуальный стиль!</h1>
                </div>
            </div>
            <div class="row center mt-4">
                <button class=" button btn btn-outline-light btn-lg openForm ">Запись</button>
            </div>
        </div>

        <div class="serviceBlock ">
            <div class="container">
                <div class="title">
                    <h1 class="display-3 mb-5 beigeColor">Цены и услуги</h1>
                </div>
                <div class="serviceText">

                    @for ($i=0; $i < 5; $i++) <div class="row px-5 my-4">
                        <div class="col-5 borderBlock">
                            <h1 class="display-5">{{$service[$i]->serviceName}}</h1>
                        </div>
                        <div class="col-1 mx-1 borderBlock">
                            <h1 class="display-5">{{$service[$i]->servicePrice}} руб</h1>
                        </div>
                </div>
                @endfor
                <div class="row">
                    <div class="col-11">
                        <a href="{{ route('services') }}"> <button class="btn btn-header btn-outline-light btn-lg">Подробнее</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="masterBlock">
        <div class="container">
            <div class="row">
                <div class="col-7 slliderMaster">
                    <div class="app">
                        <div class="cardList">
                            <button class="cardList__btn btn btn--left">
                                <div class="icon">
                                    <use xlink:href="#arrow-left">&#5176</use>
                                </div>
                            </button>
                            <div class="cards__wrapper">
                                <div class="card current--card">
                                    <div class="card__image">
                                        <img src="{{ asset('/images/barber.jpg')}}" alt="" />
                                    </div>
                                </div>
                                <div class="card next--card">
                                    <div class="card__image">
                                        <img src="{{ asset('/images/barber2.jpg')}}" alt="" />
                                    </div>
                                </div>
                                <div class="card previous--card">
                                    <div class="card__image">
                                        <img src="{{ asset('/images/barber3.jpg')}}" alt="" />
                                    </div>
                                </div>
                            </div>
                            <button class="cardList__btn btn btn--right">
                                <div class="icon">
                                    <use xlink:href="#arrow-right">&#5171</use>
                                </div>
                            </button>
                        </div>
                        <div class="infoList">
                            <div class="info__wrapper">
                                <div class="info current--info">
                                    <h1 class="text name">Евгений</h1>
                                    <h4 class="text location">Топ барбер</h4>
                                </div>
                                <div class="info next--info">
                                    <h1 class="text name">Александр</h1>
                                    <h4 class="text location">Младший барбер</h4>
                                </div>
                                <div class="info previous--info">
                                    <h1 class="text name">Анастасия</h1>
                                    <h4 class="text location">Барбер</h4>
                                </div>
                            </div>
                        </div>
                        <div class="app__bg">
                            <div class="app__bg__image current--image">
                                <img src="{{ asset('/images/barber.jpg')}}" alt="" />
                            </div>
                            <div class="app__bg__image next--image">
                                <img src="{{ asset('/images/barber2.jpg')}}" alt="" />
                            </div>
                            <div class="app__bg__image previous--image">
                                <img src="{{ asset('/images/barber3.jpg')}}" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="masterTitle text-center">
                        <h1 class="display-3 mb-5 beigeColor">Наша команда</h1>
                    </div>
                    <div class="margin text-center">
                        <h1 class="master display-5">Нашим опытным барберам подвластна любая стрижка.
                            Классика или нью-скул,любое ваше желание выполнят с лёгкостью и на высочайшем уровне.
                        </h1>
                    </div>
                    <div class="row center mt-4 mb-2">
                        <div class=" col-11">
                            <a href="{{ route('masters') }}"> <button class="btn btn-header btn-outline-light btn-lg">Подробнее</button></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="aboutBlock">
        <div class="background2">
            <div class="container">
                <div class="title">
                    <h1 class="display-3 mb-5 beigeColor">О барбершопе Blade</h1>
                </div>
                <div class="serviceText">
                    <div class="col-7 px-4">
                        <h1 class="display-5">Blade Barbershop — намного больше, чем просто мужская парикмахерская.
                            Это место, где Вам помогут найти свой собственный, неповторимый стиль. Стоит довериться
                            мастерам Blade один раз, и, поверьте, новый образ не оставит Вас равнодушным. Мужские
                            стрижки и опасное бритье — это наш профиль, и мы уверены, что наши барберы делают это лучше всех.
                        </h1>
                    </div>
                    <div class="row">
                        <div class="col-11">
                            <button class="btn btn-header btn-outline-light btn-lg openForm">Записаться</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="productBlock text-center">
        <div class="container">
            <div class="title">
                <h1 class="display-3 mb-5 beigeColor">Наши товары</h1>
            </div>
            <div class="serviceText text-center">
                <h1 class="display-5">У нас есть большое количество роскошных продуктов, разработанных специально для
                    мужчин.
                    Ваш барбер посоветует, какие лучше вам подойдут и расскажет как ими пользоваться.</h1>
                <a href="{{ route('cosmetics') }}"> <button class="btn btn-header btn-outline-light btn-lg">Подробнее</button></a>

            </div>
        </div>
    </div>

    <div class="contactBlock">
        <div class="container">
            <div class="row">
                <div class="col-6 contactText">
                    <div class="title">
                        <h1 class="display-3 mb-5 beigeColor">Контакты</h1>
                    </div>
                    <div class="px-4 mb-4 margin">
                        <h1 class="display-6"> Адрес</h1>
                        <h1 class="display-5"> Г. Минск, пр. Независимости, 93</h1>
                        <h1 class="display-6"> Телефон </h1>
                        <h1 class="display-5"> +375447301493 </h1>
                        <h1 class="display-6"> График работы </h1>
                        <h1 class="display-5"> Понедельник-воскресенье с 10.00 до 21.00 </h1>
                    </div>
                    <a href="{{ route('contacts') }}"> <button class="btn btn-header btn-outline-light btn-lg">Подробнее</button></a>
                </div>
                <div class="col-6 map">
                    <div class="ymap" style="position:relative;overflow:hidden;">
                        <a href="https://yandex.by/maps/157/minsk/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Минск</a>
                        <a href="https://yandex.by/maps/157/minsk/?ll=27.555691%2C53.902735&utm_medium=mapframe&utm_source=maps&z=12" style="color:#eee;font-size:12px;position:absolute;top:14px;"></a>
                        <iframe src="https://yandex.by/map-widget/v1/?ll=27.555691%2C53.902735&z=12" width="610" height="530" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src=" https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.3/gsap.min.js"></script>
<script src="{{ asset('js//imagesloaded.pkgd.min.js')}}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('js/datepicker.js') }}"></script>
<script>
    $(function() {
        $('input[type="tel"]').mask('+375(00)000-00-00');
    });

    let unavailableDates = '';
    var dateToday = new Date();
    $.datepicker.setDefaults($.datepicker.regional["ru"]);
    $("#customDatePicker").datepicker({
        dateFormat: "dd.mm.yy",
        minDate: dateToday,
        beforeShowDay: function(date) {
            var stringDate = $.datepicker.formatDate('dd.mm.yy', date);
            if (unavailableDates != '') {
                var isUnavailable = unavailableDates.includes(stringDate);
                return [!isUnavailable];
            }
            return [true];
        },
    });

    $('input[name="date"]').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{url('freeDateS')}}",
            type: 'post',
            data: {
                master: $('select[name="master"]').val(),
                time: $('select[name="time"]').val(),
            },
            success(data) {
                unavailableDates = data.message.split(' ');
                $("#customDatePicker").datepicker('refresh');
            }
        });
    });

    $('select[name="master"]').change(function(e) {
        let master1 = $(this).val();
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{url('selectTime')}}",
            type: 'POST',
            data: {
                date1: $('input[name="date"]').val(),
                master1: master1,
            },
            success(data) {
                $('select[name="time"]').html(data.message);
            }
        });
    });
    $('input[name="phone"]').change(function(e) {
        e.preventDefault();
        let phone = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{url('correctPhone')}}",
            type: 'POST',
            data: {
                phone: phone,
            },
            success(data) {
                if (data.status) {
                    $('input[name="phone"]').removeClass('error');
                    $(`p[class="errorT phone"]`).remove();
                    $('.btnSignUp').prop('disabled', false);
                } else {
                    data.fields.forEach(function(field) {
                        $('.btnSignUp').prop('disabled', true);
                        $(`input[name="${field}"]`).addClass('error');
                        $(`p[class="errorT ` + field + `"]`).remove();
                        $(`input[name="${field}"]`).after('<p class = "errorT ' + field + '">' + data.message + '</p>');
                    });
                }
            }
        });
    });
    $('input[name="email"]').change(function(e) {
        e.preventDefault();
        let email = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{url('correctEmail')}}",
            type: 'POST',
            data: {
                email: email,
            },
            success(data) {
                if (data.status) {
                    $('input[name="email"]').removeClass('error');
                    $(`p[class="errorT email"]`).remove();
                    $('.btnSignUp').prop('disabled', false);
                } else {
                    data.fields.forEach(function(field) {
                        $('.btnSignUp').prop('disabled', true);
                        $(`input[name="${field}"]`).addClass('error');
                        $(`p[class="errorT ` + field + `"]`).remove();
                        $(`input[name="${field}"]`).after('<p class = "errorT ' + field + '">' + data.message + '</p>');
                    });
                }
            }
        });
    });
    $('input[name="date"]').change(function(e) {
        e.preventDefault();
        let date1 = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{url('selectTime')}}",
            type: 'POST',
            data: {
                date1: date1,
                master1: $('select[name="master"]').val()
            },
            success(data) {
                $('select[name="time"]').html(data.message);
            }
        });

    });
    $('.btnSignUp').click(function(e) {
        e.preventDefault();
        $(`input`).removeClass('error');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let date = $('input[name="date"]').val(),
            name = $('input[name="name"]').val(),
            phone = $('input[name="phone"]').val(),
            email = $('input[name="email"]').val(),
            master = $('select[name="master"]').val(),
            time = $('select[name="time"]').val(),
            service = $('select[name="service"]').val(),
            id = $('.id').text();
        $.ajax({
            url: "{{url('serviceRegistration')}}",
            type: 'POST',
            data: {
                user_id: id,
                name: name,
                phone: phone,
                email: email,
                date: date,
                master: master,
                time: time,
                service: service,
            },
            success(data) {
                $(`input`).removeClass('error');
                $(`select`).removeClass('error');
                if (data.status) {
                    alert(data.message);
                    document.location.reload();
                } else {
                    data.fields.forEach(function(field) {
                        $(`input[name="${field}"]`).addClass('error');
                        $(`select[name="${field}"]`).addClass('error');
                        $('.msg').removeClass('none').text(data.message);
                    });
                }
            }
        });
    });
</script>
@endsection