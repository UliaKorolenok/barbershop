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
                    @foreach($masters as $el)
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
<div class="masters">
    <div class="background">
        <div class="background2">
            <div class="container">
                <div class="row">
                    <div class="col-7">
                        <div class="masterTitle">
                            <h1 class="display-3 beigeColor">Мастера</h1>
                        </div>
                        <div class="text">
                            <h1 class="display-6">Нашим опытным барберам подвластна любая стрижка.
                                Классика или нью-скул,любое ваше желание выполнят с лёгкостью и на высочайшем уровне.</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bgMaster pb-5">
        <div class="container">
            @if(isset($search))
            <div class="row pt-3 mb-0">
                <div class="row">
                    <div class="col-8 px-4 my-auto">
                        <h1 class="display-5">Результаты поиска по запросу: {{$search}}</h1>

                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('masters') }}"> <button style="width:auto" class="btn btn-header btn-outline-light btn-lg">Показать всех мастеров</button></a>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                @foreach($masters as $el)
                <div class="col-6">
                    <div class=" card-body">
                        <div class="cardBack">
                            <div class="row">
                                <div class="col-4 my-auto">
                                    <img src="{{ asset('/storage/'.$el->masterImg)}}" alt="">
                                </div>
                                <div class="col-8 ">
                                    <div class="row">
                                        <div class="col-5">
                                        </div>
                                        <div class="col-7 masterMark">
                                            <div class="form">
                                                <div class="markM">
                                                    @for($i=0; $i<5 ;$i++) @if($i < round($el->masterRating, 0) )
                                                        ★
                                                        @else
                                                        ☆
                                                        @endif
                                                        @endfor
                                                </div>
                                                <h5 class="card-title text-center mb-1"><span class="elMark {{$el->id}}">{{$el->masterRating}}</span>/5 <span style="font-size: 80%;"> (Оценок:
                                                        @php $count = 0 @endphp
                                                        @foreach($masterRatings as $elem)
                                                        @if($el->id == $elem->master_id)
                                                        @if($elem->mark != -1)
                                                        @php $count++; @endphp
                                                        @endif
                                                        @endif
                                                        @endforeach {{$count}})</span> </h5>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="auto">
                                        <h5 class="card-title">{{$el->masterFio}} </h5>
                                        <p class="card-text">{{$el->masterDescr}}</p>
                                    </div>
                                    <div class="text-right">
                                        <button class="{{$el->id}} button btn btn-outline-light btn-lg openForm ">Записаться</button>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('js/datepicker.js') }}"></script>
<script>
    $('.openForm').click(function(e) {
        $('.block-popup, .overlay').fadeIn();
        let id = $(this).attr('class').split(' ')[0];
        $(`select[name="master"] option[value=${id}]`).prop('selected', true);
    })
    $('.block-popup span').click(function(e) {
        $('.block-popup, .overlay').fadeOut();
    })

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
                        $(`p[class="errorT `+field+`"]`).remove();
                        $(`input[name="${field}"]`).after('<p class = "errorT '+field+'">'+data.message+'</p>');
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
                        $(`p[class="errorT `+field+`"]`).remove();
                        $(`input[name="${field}"]`).after('<p class = "errorT '+field+'">'+data.message+'</p>');
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