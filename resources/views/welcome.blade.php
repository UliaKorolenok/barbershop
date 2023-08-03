<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>



                    <td id="msg" class=""></td>
                    else if (fieldName == 'masterFio') {
      let date = $(`.${id}.date`).text();
      let time = $(`.${id}.time`).text();
      let options;
      $.ajax({
        url: "{{url('freeMaster')}}",
        type: 'post',
        data: {
          master: text,
          date: date,
          time: time,
        },
        success(data) {
          options = data.message;
          $("#msg").html('<plaintext>'+options+'</plaintext>');
        }
      });

      function sayHi() {
        options = $("#msg").text();
        thisTd.replaceWith('<td class="' + id + ' ' + fieldName + '"> <select name="' + fieldName + '" class="repl" >' + options + ' </select></td> ');

}
      setTimeout(sayHi, 2000);

      $('select').each(function(el) {
      alert('1');
      
        $(this).focus();
        alert('3');
   
    });
    


                </div>
            </div>
        </div>
    </body>

    
</html>








<div class="backgr">
  <div class="background2">
    <div class="adminProfile">
      <div class="profileBox">
        <div class="title text-center mb-5">
          <h1 class="display-3 beigeColor">Кабинет администратора</h1>
        </div>
        <div class="row box">
          <div class="col">
            <div class="row"> <a class="tablinks" id="defaultOpen" onclick="openTab(event, 'prof')">Профили</a></div>
            <div class="row"> <a class="tablinks" onclick="openTab(event, 'schedule')">Забронированные услуги</a></div>
            <div class="row"> <a class="tablinks" onclick="openTab(event, 'discount')">Программа лояльности</a></div>
          </div>
          <div class="col-9 sep">
            <div id="prof" class="tabcontent">
              <div class="row">
                <div class="col-5">
                  <h4>Профили</h4>
                </div>
                <div class="col-7">
                  <form name="search" action="" method="GET" class="searchForm">
                    {{csrf_field()}}
                    <div class="search-container">
                      <input type="search" class="form-control" name="queryUser" placeholder="Поиск">
                    </div>
                  </form>
                </div>
              </div>
              <table class="table text-white mt-4">
                <thead>
                  <tr>
                    <th scope="col">Имя</th>
                    <th scope="col">Телефон</th>
                    <th scope="col">Email</th>
                    <th scope="col">Скидка</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $el)
                  @if ($el->name == '0')
                  @else
                  <tr class="user">
                    <td class="{{$el->id}} name">{{$el->name}} </td>
                    <td class="{{$el->id}} phone">{{$el->phone}}</td>
                    <td class="{{$el->id}} email">{{$el->email}}</td>
                    <td class="{{$el->id}} discount">{{$el->discount}}</td>
                    <td> <a href="deleteUser/{{$el->id}}">Удалить</a></td>
                  </tr>
                  @endif
                  @endforeach
                </tbody>
              </table>
            </div>
            <div id="schedule" class="tabcontent">
              <div class="row">
                <div class="col-5">
                  <h4>Забронированные услуги</h4>
                </div>
                <div class="col-7">
                  <form name="search" action="" method="GET" class="searchForm">
                    {{csrf_field()}}
                    <div class="search-container">
                      <input type="search" class="form-control" name="queryShcedule" placeholder="Поиск">
                    </div>
                  </form>
                </div>
              </div>

              <table class="table text-white mt-4">
                <thead>
                  <tr>
                    <th scope="col">Пользователь</th>
                    <th scope="col">Услуга</th>
                    <th scope="col">Мастер</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Дата</th>
                    <th scope="col">Время</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($schedules as $schedule)
                  <tr class="schedule">
                    <td>{{$schedule->name}} ({{$schedule->phone}})</td>
                    @foreach ($services as $service)
                    @if ($service->id == $schedule->service_id)
                    <td class="{{$schedule->id}} serviceName">{{$service->serviceName}}</td>
                    @endif
                    @endforeach
                    @foreach ($masters as $master)
                    @if ($master->id == $schedule->master_id)
                    <td class="{{$schedule->id}} masterFio">{{$master->masterFio}}</td>
                    @endif
                    @endforeach
                  
                    @foreach ($users as $user)
                    @if ($user->id == $schedule->user_id && $user->id != 0)
                    @if ($user->discount != 0)
                    @php $discountPrice = $service->servicePrice * ((100 - $user->discount) / 100) @endphp
                    @else @php $discountPrice = 0 @endphp
                    @endif
                    @else @php $discountPrice = 0 @endphp
                    @endif
                    @endforeach
                    <td> @if ($discountPrice != 0) {{$discountPrice}} ({{$service->servicePrice}}) @else {{$service->servicePrice}} @endif </td>
                    <td class="{{$schedule->id}} date">{{$schedule->date}}</td>
                    <td class="{{$schedule->id}} time">{{$schedule->time}}</td>
                    <td><a href="deleteSchedule/{{$schedule->id}}">Удалить</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div id="discount" class="tabcontent">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="jquery-ui-i18n.js"></script>
<script src="{{ asset('js/datepicker.js') }}"></script>
<script>
  $(function() {
    $('input[type="phone"]').mask('+375(00)000-00-00');
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


  $('input[name="queryUser"]').keyup(function() {
    $.each($("tbody tr"), function() {
      if ($(this).text().toLowerCase().indexOf($('input[name="queryUser"]').val().toLowerCase()) == -1) {
        $(this).hide();
      } else {
        $(this).show();
      }
    });
  });

  $('input[name="queryShcedule"]').keyup(function() {
    $.each($("tbody tr"), function() {
      if ($(this).text().toLowerCase().indexOf($('input[name="queryShcedule"]').val().toLowerCase()) == -1) {
        $(this).hide();
      } else {
        $(this).show();
      }
    });
  });

  $('.user > td').dblclick(function(e) {
    let text = $(this).text();
    let id = $(this).attr('class').split(' ')[0];
    let fieldName = $(this).attr('class').split(' ')[1];
    $(this).replaceWith('<td class="' + id + ' ' + fieldName + '"><input type="' + fieldName + '" class="form-control repl" value="' + text + '" /></td> ');
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
      let data = {!!json_encode($services) !!},
        options = "";
      data.forEach(function(el) {
        if (el.serviceName == text) {
          options += '<option value="' + el.id + ' ' + el.serviceName + '" selected>' + text + ' (цена: ' + el.servicePrice + 'р.)</option> '
        } else {
          options += '<option value="' + el.id + ' ' + el.serviceName + '">' + el.serviceName + ' (цена: ' + el.servicePrice + 'р.)</option> ';
        }
      });
      $("#msg").html('<plaintext>'+options+'</plaintext>');
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
          time: time,
        },
        success(data) {
          options = data.message;
          thisTd.replaceWith('<td class="' + id + ' ' + fieldName + '"> <select name="' + fieldName + '" class="repl" >' + options + ' </select></td> ');

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
          time: time,
        },
        success(data) {
          thisTd.replaceWith('<td class="' + id + ' ' + fieldName + '"><input type="text" id="customDatePicker" value="' + text + '" readonly></td>');
          let unavailableDays = data.message.split(' ');
          i = unavailableDays.indexOf(text);
          if (i >= 0) {
            unavailableDays.splice(i, 1);
          }
          var dateToday = new Date();
          $.datepicker.setDefaults($.datepicker.regional["ru"]);
          $("#customDatePicker").datepicker({
            dateFormat: "yy-mm-dd",
            minDate: dateToday,
            beforeShowDay: function(date) {
              var dateString = $.datepicker.formatDate("yy-mm-dd", date);
              if ($.inArray(dateString, unavailableDays) !== -1) {
                return [false, "unavailable-day", "Unavailable"];
              }
              return [true, "", "Available"];
            }
          });
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
          thisTd.replaceWith('<td class="' + id + ' ' + fieldName + '"><select name="' + fieldName + '" class="repl" >' + data.message + ' </select></td>');
        }
      });
    }

    $('select').each(function(el) {

        $(this).focus();

   
    });
    


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
</script>