@php use Carbon\Carbon; @endphp
@extends('layouts.app')
@section('content')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">

@if (Auth::user()->email == 'admin@gmail.com')
@include('adminPanel')
@else
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
                        @guest <input type="text" placeholder="Введите имя" name="nameF" id="name_input" required />
                        @else <input type="text" placeholder="Введите имя" name="nameF" value="{{Auth::user()->name}}" id="name_input" required />@endguest
                    </div>
                </div>
                <div class="col-6">
                    <div class="email">
                        @guest <input type="text" placeholder="Введите email" name="email" id="email_input" required />
                        @else <input type="text" placeholder="Введите email" value="{{ Auth::user()->email }}" name="emailF" id="email_input" required />@endguest
                    </div>
                </div>
            </div>
            <div class="phone">
                @guest <input type="tel" placeholder="Введите номер телефона" name="phone" id="phone_input" required />
                @else <input type="tel" placeholder="Введите номер телефона" value="{{ Auth::user()->phone }}" name="phoneF" id="phone_input" required />@endguest
            </div>
            <div class="subject">
                <select placeholder="Выберите услугу" name="serviceF">
                    <option disabled hidden selected>Выберите услугу</option>
                    @foreach($services as $el)
                    <option value="{{$el->id}}">{{$el->serviceName}} (цена: {{$el->servicePrice}} руб.)</option>
                    @endforeach
                </select>
            </div>
            <div class="subject">
                <select placeholder="Выберите мастера" name="masterF" id="subject_input" required>
                    <option disabled hidden selected>Выберите мастера</option>
                    @foreach($masters as $el)
                    <option value="{{$el->id}}">{{$el->masterFio}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="subject">
                        <input id="customDatePickerF" type="text" class="date" name="dateF" placeholder="Выберите дату" readonly />
                    </div>
                </div>
                <div class="col-6">
                    <div class="subject">
                        <select placeholder="Выберите время" name="timeF" id="subject_input" required>
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
    </div>
</div>
<div class="overlay"></div>
<div class="background">
  <div class="background2">
   
      <div class="profile">
        <div class="profileBox">

          <div class="title text-center mb-5">
            <h1 class="display-3 beigeColor">Личный кабинет</h1>
          </div>
          <div class="row box">

            <div class="col-3">
              <div class="row"> <a class="tablinks" id="defaultOpen" onclick="openTab(event, 'prof')">Профиль</a></div>
              <div class="row"> <a class="tablinks" onclick="openTab(event, 'schedule')">Забронированные услуги</a></div>
              <div class="row"> <a class="tablinks" onclick="openTab(event, 'discount')">Программа лояльности</a></div>
              <div class="row"> <a class="tablinks" onclick="openTab(event, 'mark')">Оценки @if(count($marks) !=0)<span class="countMarks">{{count($marks)}}</span>@endif</a></div>
            </div>

            <div class="col-9 sep">
              <div id="prof" class="user tabcontent">
                <h4>Профиль</h4>
                <p class="pl-3 text-justify mt-3">
                  Поля таблицы, отмеченные знаком ✎ можно редактировать. Для редактирования необходимо совершить двойной щелчок мыши по изменяемому полю.
                </p>
                <p>Имя ✎:<span class="{{ Auth::user()->id }} name"> {{ Auth::user()->name }} </span></p>
                <p>Телефон ✎: <span class="{{ Auth::user()->id }} phone"> {{ Auth::user()->phone }}</span></p>
                <p>Email ✎:<span class="{{ Auth::user()->id }} email"> {{ Auth::user()->email }}</span></p>
                <p>Скидка: {{ Auth::user()->discount }}%</p>
                <p class="id">{{ Auth::user()->id }}</p>
              </div>

              <div id="schedule" class="tabcontent ">
                <div class="row">
                  <div class="col-4">
                    <h4>Забронированные услуги</h4>
                  </div>

                  <div class="col-2 text-right mt-0">
                    <h7>Мои записи:</h7>
                  </div>
                  <div class="col-2">
                    <select name="sortTime">
                      <option value="future">Будущие</option>
                      <option value="past">Прошедшие</option>
                    </select>
                  </div>

                  <div class="col-2  text-right mt-0">
                    <h7>Сортировать по:</h7>
                  </div>
                  <div class="col-2">
                    <select name="sort">
                      <option value="price">цене</option>
                      <option value="date">дате</option>
                    </select>
                  </div>
                </div>
                <p>
                <button class="button btn btn-outline-light btn-lg openForm ">Добавить запись</button>
                </p>
                <p class="pl-3 text-justify mt-3">
                  Поля таблицы, отмеченные знаком ✎ можно редактировать. Для редактирования необходимо совершить двойной щелчок мыши по изменяемому полю.
                  Для удаления записи нажмите на 🗑.
                </p>
               <table id="table" class="table table-responsive-sm text-white mt-4">
                  
                  </table>
              </div>
              <div id="discount" class="tabcontent">
                <h4 class="mb-5">Программа лояльности</h4>
                <div class="row">
                  <div class="col-2 mt-5 inf">
                    Посещения
                  </div>
                  <div class="col-8">
                    <div class="row text-center">
                      <div class="col-2 allCount">
                        <p class="point">●</p>
                        <p>{{$min}}</p>
                      </div>
                      <div class="col-2 allCount">
                        <p class="point">●</p>
                        <p>{{$min+1}}</p>
                      </div>
                      <div class="col-2 allCount">
                        <p class="point">●</p>
                        <p>{{$min+2}}</p>
                      </div>
                      <div class="col-2 allCount">
                        <p class="point">●</p>
                        <p>{{$min+3}}</p>
                      </div>
                      <div class="col-2 allCount">
                        <p class="point">●</p>
                        <p>{{$min+4}}</p>
                      </div>
                      <div class="col-2 allCount">
                        <p class="point">●</p>
                        <p>{{$min+5}}</p>
                      </div>
                      <div class="col-2 count none">
                        <p class="point">●</p>
                        <p>{{$count}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-2 mt-5 inf">
                    @if ($count % 6 == 0) Скидка увеличена на 5%
                    @else Скидка {{ Auth::user()->discount + 5}}%
                    @endif
                  </div>
                </div>
                <div class="row mt-4">
                  *каждое 6-ое посещение барбершопа увеличивает вашу скидку на 5% (максимальноя скидка 20%).
                </div>
              </div>
              <div id="mark" class="tabcontent">
                <h4>Оценки</h4>
                @if(count($marks) !=0)
                <p>Здесь вы можете оценить работу мастера!</p>
                @else
                <p>Пока нет работ, которые вы можете оценить!</p>
                @endif
                <div class="row">
                  @foreach($marks as $mark)
                  <div class="col-6 {{$mark->id}}">
                    <div class=" card-body">
                      <div class="cardBack">
                        <span class="{{$mark->id}} mx-2 mb-3">☓</span>
                        <div class="row padd">

                          <div class="col-4 my-auto">
                            @foreach($masters as $el)
                            @if($mark->master_id==$el->id)
                            <img src="{{ asset('/storage/'.$el->masterImg)}}" alt="">
                            @endif
                            @endforeach
                          </div>
                          <div class="col-8 ">
                            <div class="row">
                              <div class="col-3">
                              </div>
                              <div class="col-9 masterMark mb-2">
                                <div class="form">
                                  <form method="POST" class="sendReview" id="sendReview" autocomplete="off" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="row markS">
                                      <div class="col-12">
                                        <div class="input_item">
                                          <div class="rating-area">
                                            @foreach($masters as $el)
                                            @if($mark->master_id==$el->id)
                                            <input type="radio" id="star-5{{$mark->id}}" name="{{$mark->id}}" value="5">
                                            <label for="star-5{{$mark->id}}" title="Оценка «5»"></label>
                                            <input type="radio" id="star-4{{$mark->id}}" name="{{$mark->id}}" value="4">
                                            <label for="star-4{{$mark->id}}" title="Оценка «4»"></label>
                                            <input type="radio" id="star-3{{$mark->id}}" name="{{$mark->id}}" value="3">
                                            <label for="star-3{{$mark->id}}" title="Оценка «3»"></label>
                                            <input type="radio" id="star-2{{$mark->id}}" name="{{$mark->id}}" value="2">
                                            <label for="star-2{{$mark->id}}" title="Оценка «2»"></label>
                                            <input type="radio" id="star-1{{$mark->id}}" name="{{$mark->id}}" value="1">
                                            <label for="star-1{{$mark->id}}" title="Оценка «1»"></label>
                                            @endif
                                            @endforeach
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </form>

                                </div>
                              </div>
                            </div>
                            @foreach($masters as $el)
                            @if($mark->master_id==$el->id)
                            <p class="card-text">Мастер: {{$el->masterFio}}</p>
                            @endif
                            @endforeach
                            @foreach($schedules as $sch)
                            @if($mark->schedule_id==$sch->id)
                            @foreach($services as $serv)
                            @if($serv->id==$sch->service_id)
                            <p class="card-text">Услуга: {{$serv->serviceName}}</p>
                            @endif
                            @endforeach
                            @endif
                            @endforeach
                            @foreach($schedules as $sch)
                            @if($mark->schedule_id==$sch->id)
                            @php $date = Carbon::parse($sch->date)->format('d.m.Y'); @endphp
                            <p class="card-text">Дата выполнения: {{$date}}</p>
                            @endif
                            @endforeach
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
        </div>
      </div>

  </div>
</div>
@endif
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('js/datepicker.js') }}"></script>
<script>
  $('.openForm').click(function(e){
    $('.block-popup, .overlay').fadeIn();
  })
  $('.block-popup span').click(function(e){
    $('.block-popup, .overlay').fadeOut();
  })

  $('.openFormServ').click(function(e){
    $('.block-popupS, .overlayS').fadeIn();
  })
  $('.block-popupS span').click(function(e){
    $('.block-popupS, .overlayS').fadeOut();
  })
  
  $(function() {
        $('input[type="tel"]').mask('+375(00)000-00-00');
    });

    let unavailableDates = '';
    var dateToday = new Date();
    $.datepicker.setDefaults($.datepicker.regional["ru"]);
    $("#customDatePickerF").datepicker({
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

    $('input[name="dateF"]').click(function(e) {
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
                master: $('select[name="masterF"]').val(),
                time: $('select[name="timeF"]').val(),
            },
            success(data) {
                unavailableDates = data.message.split(' ');
                $("#customDatePickerF").datepicker('refresh');
            }
        });
    });

    $('select[name="masterF"]').change(function(e) {
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
                date1: $('input[name="dateF"]').val(),
                master1: master1,
            },
            success(data) {
                $('select[name="timeF"]').html(data.message);
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
                        $(`p[class="errorT `+field+`F"]`).remove();
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
                        $(`input[name="${field}F"]`).addClass('error');
                        $(`p[class="errorT `+field+`"]`).remove();
                        $(`input[name="${field}"]`).after('<p class = "errorT '+field+'">'+data.message+'</p>');
                    });
                }
            }
        });
    });
    $('input[name="dateF"]').change(function(e) {
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
                master1: $('select[name="masterF"]').val()
            },
            success(data) {
                $('select[name="timeF"]').html(data.message);
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
        let date = $('input[name="dateF"]').val(),
            name = $('input[name="nameF"]').val(),
            phone = $('input[name="phone"]').val(),
            email = $('input[name="email"]').val(),
            master = $('select[name="masterF"]').val(),
            time = $('select[name="timeF"]').val(),
            service = $('select[name="serviceF"]').val(),
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
                        $(`input[name="${field}F"]`).addClass('error');
                        $(`select[name="${field}F"]`).addClass('error');
                        $('.msg').removeClass('none').text(data.message);
                    });
                }
            }
        });
    });


    $(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    let check = $('select[name="sort"]').val();
    let checkTime = $('select[name="sortTime"]').val(),
      id = $('.id').text();
    $.ajax({
      url: "{{url('sort')}}",
      type: 'GET',
      data: {
        user_id: id,
        check: check,
        checkTime: checkTime,
      },
      success(data) {
        $('#table').html(" ");
        $('#table').html(data.td);
        change();
      }
    });
  });
  
  let count = $('.count').text();
  $('.allCount').each(function() {
    if (count == $(this).text()) {
      $(this).addClass('check');
      let point = $(this).attr('class').split(' ')[2];
      $(this).attr('style', 'margin-top: 1% ; color: #A59982; font-weight: bold;  font-size:110%;');
       $(`.${point} p:first`).attr('style', 'margin-bottom: 0; color: #A59982; font-weight: bold; font-size:280%;');
    }
  });
  $('p > span').dblclick(function(e) {
    let text = $(this).text();
    let id = $(this).attr('class').split(' ')[0];
    let fieldName = $(this).attr('class').split(' ')[1];
    $(this).replaceWith('<span><td class="' + id + ' ' + fieldName + ' mt-5"><input type="' + fieldName + '" class="form-control repl" value="' + text + '" /></td> </span>');
    $('.repl').focus();
    $('.repl').blur(function(e) {
      let val = $(this).val();
      if (val == text) {
        $('.repl').replaceWith(val);
      } else {
        e.preventDefault();
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          url: "{{url('updateUser')}}",
          type: 'post',
          data: {
            val: val,
            id: id,
            fieldName: fieldName,
          },
          success(data) {
            if (data.status) {
              alert(data.message);
              $('.repl').replaceWith(val);
            } else {
              alert(data.message);
              $('.repl').addClass('error');
            }
          }
        });
      }
    });
  });

  function change() {
  $('.schedule > td').dblclick(function(e) {
    e.preventDefault();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    let thisTd = $(this),
      text = $(this).text(),
      id = $(this).attr('class').split(' ')[0],
      fieldName = $(this).attr('class').split(' ')[1];

    if (fieldName == 'serviceName') {
      let data = {!!json_encode($services)!!},
        options = "";
      data.forEach(function(el) {
        if (el.serviceName == text) {
          options += '<option value="' + el.id + ' ' + el.serviceName + '" selected>' + text + ' (цена: ' + el.servicePrice + ' руб.)</option> '
        } else {
          options += '<option value="' + el.id + ' ' + el.serviceName + '">' + el.serviceName + ' (цена: ' + el.servicePrice + ' руб.)</option> ';
        }
      });
      thisTd.replaceWith('<td class="' + id + ' ' + fieldName + '"> <select name="' + fieldName + '" class="repl" >' + options + ' </select></td> ');

    } else if (fieldName == 'masterFio') {
      let date = $(`.${id}.date`).text();
      let time = $(`.${id}.time`).text();
      let options;
      $.ajax({
        url: "{{url('freeMaster')}}",
        type: 'post',
        data: {
          master: text,
          date: date,
          time: time+':00',
        },
        success(data) {
          options = data.message;
          thisTd.replaceWith('<td class="' + id + ' ' + fieldName + '"> <select name="' + fieldName + '" class="repl" >' + options + ' </select></td> ');
          $('.repl').focus();
          $('.repl').blur(function(e) {
            let val = $('.repl').val();
            let fieldId = val.split(' ')[0];
            let val2 = val.split(' ');
            i = val2.indexOf(val2[0]);
            if (i >= 0) {
              val2.splice(i, 1);
            }
            let val3 = val2.join(' ');

            if (val3 == text) {
              $('.repl').replaceWith(val3);
            } else {
              $.ajax({
                url: "{{url('update')}}",
                type: 'post',
                data: {
                  val: fieldId,
                  id: id,
                  fieldName: fieldName,
                },
                success(data) {
                  if (data.status) {
                    alert(data.message);
                    $('.repl').replaceWith(val3);
                  } else {
                    alert(data.message);
                    $('.repl').addClass('error');
                  }
                }
              });
            }
          });
        }
      });
    } else if (fieldName == 'date') {
      let master = $(`.${id}.masterFio`).text();
      let time = $(`.${id}.time`).text();
      $.ajax({
        url: "{{url('freeDate')}}",
        type: 'post',
        data: {
          master: master,
          date: text,
          time: time+':00',
        },
        success(data) {
          thisTd.replaceWith('<td class="' + id + ' ' + fieldName + '"><input type="text" class="repl" id="customDatePicker" value="' + text + '" readonly></td>');
          let unavailableDates = data.message.split(' ');
          i = unavailableDates.indexOf(text);
          if (i >= 0) {
            unavailableDates.splice(i, 1);
          }
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
            onClose: function(date) {
              $('.repl').replaceWith(date);
            },
            onSelect: function(date, datepicker) {
              if (date == text) {
                $('.repl').replaceWith(date);
              } else {
                $.ajax({
                  url: "{{url('update')}}",
                  type: 'post',
                  data: {
                    val: date,
                    id: id,
                    fieldName: fieldName,
                  },
                  success(data) {
                    if (data.status) {
                      alert(data.message);
                      $('.repl').replaceWith(date);
                    } else {
                      alert(data.message);
                      $('.repl').addClass('error');
                    }
                  }
                });
              }
            },

          });
          $('.repl').focus();

        }
      });
    } else if (fieldName == 'time') {
      let date = $(`.${id}.date`).text();
      let master = $(`.${id}.masterFio`).text();
      $.ajax({
        url: "{{url('freeTime')}}",
        type: 'post',
        data: {
          master: master,
          date: date,
          time: text,
        },
        success(data) {
          thisTd.replaceWith('<td class="' + id + ' ' + fieldName + '"><select name="' + fieldName + '" class="repl" >'+data.message+' </select></td>');
          $('.repl').focus();

          $('.repl').blur(function(e) {
            let opt = $(this).find('option:selected').text();
            let val = $('.repl').val();
            let fieldId = val;
            if (opt == text) {
              $('.repl').replaceWith(opt);
            } else {
              $.ajax({
                url: "{{url('update')}}",
                type: 'post',
                data: {
                  val: fieldId,
                  id: id,
                  fieldName: fieldName,
                },
                success(data) {
                  if (data.status) {
                    alert(data.message);
                    $('.repl').replaceWith(opt);
                  } else {
                    alert(data.message);
                    $('.repl').addClass('error');
                  }
                }
              });
            }
          });
        }
      });
    }

    $('.repl').focus();

    $('.repl').blur(function(e) {

      let val = $('.repl').val();
      let fieldId = val.split(' ')[0];
      let val2 = val.split(' ');
      i = val2.indexOf(val2[0]);
      if (i >= 0) {
        val2.splice(i, 1);
      }
      let val3 = val2.join(' ');

      if (val3 == text) {
        $('.repl').replaceWith(val3);
      } else {
        $.ajax({
          url: "{{url('update')}}",
          type: 'post',
          data: {
            val: fieldId,
            id: id,
            fieldName: fieldName,
          },
          success(data) {
            if (data.status) {
              alert(data.message);
              $('.repl').replaceWith(val3);
            } else {
              alert(data.message);
              $('.repl').addClass('error');
            }
          }
        });
      }
    });
  });
  }
  $('.cardBack > span').click(function(e) {
    e.preventDefault();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    let id = $(this).attr('class').split(' ')[0];
    $.ajax({
      url: "{{url('deleteMark')}}",
      type: 'GET',
      data: {
        mark_id: id,
      },
      success(data) {
        $(`.col-6.${id}`).css("display", "none");
        let count = $('.countMarks').text();
        $('.countMarks').html(count - 1);
      }
    });
  });


  function openTab(evt, name) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(name).style.display = "block";
    evt.currentTarget.className += " active";
  }
  document.getElementById("defaultOpen").click();


  $('select[name="sortTime"]').change(function(e) {
    e.preventDefault();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    let checkTime = $(this).val();
    let check = $('select[name="sort"]').val();
    let id = $('.id').text();
    $.ajax({
      url: "{{url('sort')}}",
      type: 'GET',
      data: {
        user_id: id,
        check: check,
        checkTime: checkTime,
      },
      success(data) {
        $('#table').html(" ");
        $('#table').html(data.td);
        change();
      }
    });
  });
  $('select[name="sort"]').change(function(e) {
    let id = $('.id').text();
    e.preventDefault();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    let check = $(this).val();
    let checkTime = $('select[name="sortTime"]').val();
    $.ajax({
      url: "{{url('sort')}}",
      type: 'GET',
      data: {
        user_id: id,
        check: check,
        checkTime: checkTime,
      },
      success(data) {
        $('#table').html(" ");
        $('#table').html(data.td);
        change();
      }
    });
  });

  $(".masterMark input").change(function(event) {
        event.preventDefault();
        let rate = $(this).val();
        let mark_id = $(this).attr("name");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/rateMaster",
            type: "POST",
            data: {
                rate: rate,
                mark_id: mark_id,
            },
            success(data) {
              alert('Cпасибо за Вашу оценку! Она будет учтена в рейтинге мастеров.');
              $(`.col-6.${mark_id}`).css("display", "none");
              let count = $('.countMarks').text();
              $('.countMarks').html(count - 1);
            }
        });
    });
  
</script>

@endsection