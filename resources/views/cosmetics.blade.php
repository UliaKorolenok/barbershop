@extends('layouts.app')
@section('content')

<div class="cosmForm">
    <div class="block-popup">
        <div id="container">
            <form id="myForm">
                <h1 class='beigeColor'>&bull; Подбор средства по уходу &bull;</h1>
                {{csrf_field()}}
                <div class="question1">
                    <div class="question mt-5">Для чего вы хотите подобрать средство?</div>
                    <div class="mt-3 ml-2">
                        <div class="col-3 form_radio">
                            <input type="radio" id="hair" name="type" value="волосы" checked />
                            <label for="hair">Для волос</label>
                        </div>
                        <div class="col-3 mt-1 form_radio">
                            <input type="radio" id="beard" name="type" value="борода" />
                            <label for="beard">Для бороды</label>
                        </div>
                    </div>
                </div>
                <div class="hairQuestions">
                    <div class="question mt-5">Какой у вас тип волос?</div>
                    <div class="mt-3 ml-2">
                        <div class="row">
                            <div class="col-4 form_radio">
                                <input type="radio" id="typeHair" name="typeHair" value="вьющиеся" checked />
                                <label for="typeHair">Вьющиеся</label>
                            </div>
                            <div class="col-4 mt-1 form_radio">
                                <input type="radio" id="typeHair1" name="typeHair" value="прямые" />
                                <label for="typeHair1">Прямые</label>
                            </div>
                            <div class="col-4 mt-1 form_radio">
                                <input type="radio" id="typeHair2" name="typeHair" value="волнистые" />
                                <label for="typeHair2">Волнистые</label>
                            </div>
                        </div>
                    </div>
                    <div class="question mt-3">Есть ли у вас какие-то особенности? (можно выбрать несколько)</div>
                    <div class="mt-3 ml-2">
                        <div class="row">
                            <div class="col-3 form_radio">
                                <input type="checkbox" id="peculiarity" name="peculiarity" value="перхоть" />
                                <label for="peculiarity">Перхоть</label>
                            </div>
                            <div class="col-3 mt-1 form_radio">
                                <input type="checkbox" id="peculiarity1" name="peculiarity" value="сухость" />
                                <label for="peculiarity1">Сухость</label>
                            </div>
                            <div class="col-3 mt-1 form_radio">
                                <input type="checkbox" id="peculiarity2" name="peculiarity" value="истончение" />
                                <label for="peculiarity2">Истончение волос</label>
                            </div>
                            <div class="col-3 mt-1 form_radio">
                                <input type="checkbox" id="peculiarity3" name="peculiarity" value="ничего" checked />
                                <label for="peculiarity3">Ничего из перечисленного</label>
                            </div>
                        </div>
                    </div>

                    <div class="question mt-3">Как часто вы моете голову? </div>
                    <div class="mt-3 ml-2">
                        <div class="row">
                            <div class="col-3 form_radio">
                                <input type="radio" id="washingFrequency" name="washingFrequency" value="жирные" checked />
                                <label for="washingFrequency">Каждый день</label>
                            </div>
                            <div class="col-3 mt-1 form_radio">
                                <input type="radio" id="washingFrequency1" name="washingFrequency" value="средние" />
                                <label for="washingFrequency1">Через день</label>
                            </div>
                            <div class="col-3 mt-1 form_radio">
                                <input type="radio" id="washingFrequency2" name="washingFrequency" value="средние" />
                                <label for="washingFrequency2">Раз в 2-3 дня</label>
                            </div>
                            <div class="col-3 mt-1 form_radio">
                                <input type="radio" id="washingFrequency3" name="washingFrequency" value="не жирные" />
                                <label for="washingFrequency3">Раз в неделю</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="beardQuestions">
                    <div class="question mt-3">Какая жесткость ваших волос? </div>
                    <div class="mt-3 ml-2">
                        <div class="row">
                            <div class="col-4 form_radio">
                                <input type="radio" id="rigidity" name="rigidity" value="мягкие" checked />
                                <label for="rigidity">Мягкие</label>
                            </div>
                            <div class="col-4 mt-1 form_radio">
                                <input type="radio" id="rigidity1" name="rigidity" value="средней жесткости" />
                                <label for="rigidity1">Средние</label>
                            </div>
                            <div class="col-4 mt-1 form_radio">
                                <input type="radio" id="rigidity2" name="rigidity" value="жесткие" />
                                <label for="rigidity2">Жесткие</label>
                            </div>
                        </div>
                    </div>
                    <div class="question mt-3">Есть ли у вас какие-то особенности? (можно выбрать несколько)</div>
                    <div class="mt-3 ml-2">
                        <div class="row">
                            <div class="col-3 form_radio">
                                <input type="checkbox" id="peculiarityBeard" name="peculiarityBeard" value="перхоть" />
                                <label for="peculiarityBeard">Перхоть</label>
                            </div>
                            <div class="col-3 mt-1 form_radio">
                                <input type="checkbox" id="peculiarity1Beard" name="peculiarityBeard" value="сухость" />
                                <label for="peculiarity1Beard">Сухость</label>
                            </div>
                            <div class="col-3 mt-1 form_radio">
                                <input type="checkbox" id="peculiarity2Beard" name="peculiarityBeard" value="истончение" />
                                <label for="peculiarity2Beard">Истончение волос</label>
                            </div>
                            <div class="col-3 mt-1 form_radio">
                                <input type="checkbox" id="peculiarity3Beard" name="peculiarityBeard" value="ничего" checked />
                                <label for="peculiarity3Beard">Ничего из перечисленного</label>
                            </div>
                        </div>
                    </div>

                    <div class="question mt-3">Как часто вы моете бороду?</div>
                    <div class="mt-3 ml-2">
                        <div class="row">
                            <div class="col-3 form_radio">
                                <input type="radio" id="washingFrequencyBeard" name="washingFrequencyBeard" value="жирные" checked />
                                <label for="washingFrequencyBeard">Каждый день</label>
                            </div>
                            <div class="col-3 mt-1 form_radio">
                                <input type="radio" id="washingFrequency1Beard" name="washingFrequencyBeard" value="средние" />
                                <label for="washingFrequency1Beard">Через день</label>
                            </div>
                            <div class="col-3 mt-1 form_radio">
                                <input type="radio" id="washingFrequency2Beard" name="washingFrequencyBeard" value="средние" />
                                <label for="washingFrequency2Beard">Раз в 2-3 дня</label>
                            </div>
                            <div class="col-3 mt-1 form_radio">
                                <input type="radio" id="washingFrequency3Beard" name="washingFrequencyBeard" value="не жирные" />
                                <label for="washingFrequency3Beard">Раз в неделю</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="question3">
                    <div class="question mt-3">Какой эффект вы хотите получить от средства? (можно выбрать несколько)</div>
                    <div class="mt-3 ml-2">
                        <div class="row">
                            <div class="col-4 form_radio">
                                <input type="checkbox" id="producType" name="producType" value="шампунь" checked />
                                <label for="producType">Очищение</label>
                            </div>
                            <div class="col-4 mt-1 form_radio">
                                <input type="checkbox" id="producType1" name="producType" value="объём" />
                                <label for="producType1">Увеличение объёма</label>
                            </div>
                            <div class="col-4 mt-1 form_radio">
                                <input type="checkbox" id="producType2" name="producType" value="рост" />
                                <label for="producType2">Способствование росту</label>
                            </div>
                            <div class="col-4 mt-1 form_radio">
                                <input type="checkbox" id="producType3" name="producType" value="увлажнение" />
                                <label for="producType3">Смягчение и питание</label>
                            </div>
                            <div class="col-4 mt-1 form_radio">
                                <input type="checkbox" id="producType4" name="producType" value="укладка" />
                                <label for="producType4">Укладка волос</label>
                            </div>
                        </div>
                    </div>
                    <div class="question mt-3">Каков ваш ценовой диапазон?</div>
                    <div class="mt-3 ml-2">
                        <div class="row">
                            <div class="col-4 form_radio">
                                <input type="radio" id="price" name="price" value="дешёвые" checked />
                                <label for="price">Низкий <label style="font-variant: small-caps; padding-left:5px">(до 25 руб.)</label></label>
                            </div>
                            <div class="col-4 mt-1 form_radio">
                                <input type="radio" id="price1" name="price" value="средние по цене" />
                                <label for="price1">Средний <label style="font-variant: small-caps; padding-left:5px">(от 25 до 50 руб.)</label></label>
                            </div>
                            <div class="col-4 mt-1 form_radio">
                                <input type="radio" id="price2" name="price" value="дорогие" />
                                <label for="price2">Высокий <label style="font-variant: small-caps; padding-left:5px">(от 50 руб.)</label></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <input id="nextButton" class="btn btn-header btn-outline-light btn-lg" type="button" value="Далее">
                </div>
                <div class="text-right sub">
                    <input class="btn btn-header btn-outline-light btn-lg sub" type="button" value="Подобрать средство">
                </div>
                <div class="res">

                </div>
                <span>&times;</span>
            </form>
        </div>
    </div>
    <div class="overlay"></div>
</div>

<div class="cosmetics">
    <div class="background2">
        <div class="headerCosm">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <div class="title">
                            <h1 class="display-4 mb-3 beigeColor">Мужская косметика от барбершопа Blade</h1>
                        </div>
                        <div class="text">
                            <h1 class="display-6">У нас есть большое количество продуктов, разработанных специально для мужчин.
                                Ваш барбер посоветует, что лучше подойдёт вам и расскажет как ими пользоваться.</h1>
                            <h1 class="display-6 mt-3 mb-0">Также вы можете подобрать средство по уходу за волосами подходящее именно вам!
                                Ответьте на несколько вопросов и подберите идеальное для вас средство онлайн!
                            </h1>
                            <button class="btn btn-header btn-outline-light btn-lg openForm">Подобрать средство</button>
                        </div>
                    </div>
                    <div class="col-6">
                        <img class="product1 bounce" src="{{ asset('/images/cup21.png')}} " alt="" />
                        <img class="product2 bounce" src="{{ asset('/images/shampoo1.png')}}" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg pt-3 pb-5">
        <div class="container">
            @if(isset($search))
            <div class="row pt-3 mb-0">
                <div class="row">
                    <div class="col-8 px-4 my-auto">
                        <h1 class="display-5">Результаты поиска по запросу: {{$search}}</h1>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('cosmetics') }}"> <button style="width:auto" class="btn btn-header btn-outline-light btn-lg">Показать все товары</button></a>
                    </div>
                </div>
            </div>
            @else
            <div class="sortSelect row pt-3 ">
                <div class="col-1 mt-1">
                    <h6>Сортировать по:</h6>
                </div>
                <div class="col-2">
                    <select name="sort">
                        <option value="increase">возрастанию цены</option>
                        <option value="decrease">убыванию цены</option>
                    </select>
                </div>
            </div>
            @endif

            <div class="sort">
                <div class="row">
                    @foreach($cosmetics as $el)
                    <div class="col-4 mt-4">
                        <img src="{{ asset('/images/'.$el->img)}}" class="card-img-top" alt="..." />
                        <div class="card-body fullDescr">
                            <h5 class="card-title">{{$el->name}}</h5>
                            <p class="card-text">{{$el->fullDescription}}</p>
                        </div>

                        <div class="card-body descr">
                            <h5 class="card-title pb-2">{{$el->name}}</h5>
                            <p class="card-text">{{$el->description}}</p>
                            <p class="card-text">Цена: {{$el->price}} руб.</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.openForm').click(function(e) {
        $('.block-popup, .overlay').fadeIn();
    })
    $('.block-popup span').click(function(e) {
        $('.block-popup, .overlay').fadeOut();
    })


    $('.beardQuestions').hide();
    $('.hairQuestions').hide();
    $('.question3').hide();
    $('.sub').hide();
    let count = 0;
    $('#nextButton').click(function(e) {
        var answer1 = $('input[name="type"]:checked').val();
        $('.question1').hide();
        if (count == 1) {
            $('.beardQuestions').hide();
            $('.hairQuestions').hide();
            $('#nextButton').hide();
            $('.sub').show();
            $('.question3').show();
        }
        if (answer1 == "волосы" && count != 1) {
            count = 1;
            $('.hairQuestions').show();
        }
        if (answer1 == "борода" && count != 1) {
            count = 1;
            $('.beardQuestions').show();
        }
    });

    $('.sub').click(function(e) {

        let peculiarity = [];
        $('input[name="peculiarity"]:checked').each(function() {
            peculiarity.push($(this).val());
        });
        let peculiarityBeard = [];
        $('input[name="peculiarityBeard"]:checked').each(function() {
            peculiarityBeard.push($(this).val());
        });
        let producType = [];
        $('input[name="producType"]:checked').each(function() {
            producType.push($(this).val());
        });
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let type = $('input[name="type"]:checked').val(),
            typeHair = $('input[name="typeHair"]:checked').val(),
            washingFrequency = $('input[name="washingFrequency"]:checked').val(),
            washingFrequencyBeard = $('input[name="washingFrequencyBeard"]:checked').val(),
            rigidity = $('input[name="rigidity"]:checked').val(),
            price = $('input[name="price"]:checked').val();
        $.ajax({
            url: "{{url('chooseRemedy')}}",
            type: 'POST',
            data: {
                type: type,
                typeHair: typeHair,
                peculiarity: peculiarity,
                washingFrequency: washingFrequency,
                peculiarityBeard: peculiarityBeard,
                washingFrequencyBeard: washingFrequencyBeard,
                rigidity: rigidity,
                producType: producType,
                price: price,
            },
            success(data) {
                $('.sub').hide();
                $('.question3').hide();
                $('.res').html(data.message);
            }
        });
    });

    $('select[name="sort"]').change(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let check = $(this).val();
        $.ajax({
            url: "/sortCosmetics",
            type: "POST",
            data: {
                check: check,
            },
            success(data) {
                $('.sort').html(" ");
                $('.sort').html(data.message);
            }
        });
    });
</script>
@endsection