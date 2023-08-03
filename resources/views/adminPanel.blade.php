@php use Carbon\Carbon; @endphp
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
            <input type="text" placeholder="Введите имя" name="nameF" id="name_input" required />
          </div>
        </div>
        <div class="col-6">
          <div class="email">
            <input type="text" placeholder="Введите email" name="email" id="email_input" required />
          </div>
        </div>
      </div>
      <div class="phone">
        <input type="tel" placeholder="Введите номер телефона" name="phone" id="phone_input" required />
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

<div class="block-popupS">
  <div id="container">
    <form>
      <h1 class='beigeColor'>&bull; Добавить услугу &bull;</h1>
      <div class="underline pt-2 mb-3">
      </div>
      <P class="msg none"></P>
      {{csrf_field()}}
      <div class="row mt-4">
        <div class="name">
          <input type="text" placeholder="Введите название" name="nameS" id="name_input" required />
        </div>
      </div>
      <div class="descr">
        <textarea type="text" name="descriptionS" placeholder="Введите описание" require></textarea>
      </div>
      <div class="price">
        <input type="number" placeholder="Введите цену" name="priceS" id="phone_input" required />
      </div>
      <div class="mt-2">
        <input type="file" placeholder="" name="imgS" id="phone_input" required />
      </div>
      <div class="submit text-center mt-4 mb-0">
        <input class="addServ" type="submit" value="Добавить" id="form_button" />
      </div>
    </form>
    <span>&times;</span>
  </div>
</div>
<div class="overlayS"></div>
<div class="backgr">
  <div class="background2">
    <div class="adminProfile">
      <div class="profileBox">
        <div class="title text-center mb-5">
          <h1 class="display-3 beigeColor">Кабинет администратора</h1>
        </div>
        <div class="row box">
          <div class="col-3">
            <div class="row"> <a class="tablinks" id="defaultOpen" onclick="openTab(event, 'prof')">Профили</a></div>
            <div class="row"> <a class="tablinks" onclick="openTab(event, 'schedule')">Забронированные услуги</a></div>
            <div class="row"> <a class="tablinks" onclick="openTab(event, 'reviews')">Отзывы</a></div>
            <div class="row mt-4">Контент</div>
            <div class="row"> <a class="tablinks" onclick="openTab(event, 'serv')">Услуги</a></div>
            <div class="row"> <a class="tablinks" onclick="openTab(event, 'mast')">Мастера</a></div>
            <div class="row"> <a class="tablinks" onclick="openTab(event, 'cos')">Товары</a></div>
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
                <p class="pl-3 text-justify mt-3">
                  Поля таблицы, отмеченные знаком ✎ можно редактировать. Для редактирования необходимо совершить двойной щелчок мыши по изменяемому полю.
                  Для удаления записи нажмите на 🗑.
                </p>
              </div>
              <table class="table text-white mt-4">
                <thead>
                  <tr>
                    <th scope="col">Имя ✎</th>
                    <th scope="col">Телефон ✎</th>
                    <th scope="col">Email ✎</th>
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
                    <td>{{$el->discount}}</td>
                    <td> <a class="text-center" style="font-size: 150%; color: white;" href="deleteUser/{{$el->id}}">🗑</a></td>
                  </tr>
                  @endif
                  @endforeach
                </tbody>
              </table>
            </div>
            <div id="cos" class="tabcontent">
              <div class="row">
                <div class="col-5">
                  <h4>Услуги</h4>
                </div>
                <div class="col-7">
                  <form name="search" action="" method="GET" class="searchForm">
                    {{csrf_field()}}
                    <div class="search-container">
                      <input type="search" class="form-control" name="queryUser" placeholder="Поиск">
                    </div>
                  </form>
                </div>
                <p class="pl-3 text-justify mt-3">
                  Поля таблицы, отмеченные знаком ✎ можно редактировать. Для редактирования необходимо совершить двойной щелчок мыши по изменяемому полю.
                  Для удаления записи нажмите на 🗑.
                </p>
              </div>
              <table class="table text-white mt-4">
                <thead>
                  <tr>
                    <th scope="col-1">Название ✎</th>
                    <th scope="col-1">Фото ✎</th>
                    <th scope="col-2">Описание ✎</th>
                    <th scope="col-1">Ключевые слова ✎</th>
                    <th scope="col-1">Цена ✎</th>
                    <th scope="col-1"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($cosmetics as $el)
                  <tr class="serv">
                    <td class="{{$el->id}} name">{{$el->name}} </td>
                    <td class="{{$el->id}} img {{$el->img}}"><img src="{{ asset('/images/'.$el->img)}}" alt=""></td>
                    <td class="{{$el->id}} description">{{$el->description}}</td>
                    <td class="{{$el->id}} keywords">{{$el->keywords}}</td>
                    <td class="{{$el->id}} price">{{$el->price}} руб.</td>
                    <td> <a class="text-center" style="font-size: 150%; color: white;" href="deleteCosm/{{$el->id}}">🗑</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div id="serv" class="tabcontent">
              <div class="row">
                <div class="col-5">
                  <h4>Услуги</h4>
                </div>
                <div class="col-7">
                  <form name="search" action="" method="GET" class="searchForm">
                    {{csrf_field()}}
                    <div class="search-container">
                      <input type="search" class="form-control" name="queryUser" placeholder="Поиск">
                    </div>
                  </form>
                </div>
                <p>
                  <button class="button btn btn-outline-light btn-lg openFormServ ">Добавить услугу</button>
                </p>
                <p class="pl-3 text-justify mt-3">
                  Поля таблицы, отмеченные знаком ✎ можно редактировать. Для редактирования необходимо совершить двойной щелчок мыши по изменяемому полю.
                  Для удаления записи нажмите на 🗑.
                </p>
              </div>
              <table class="table text-white mt-4">
                <thead>
                  <tr>
                    <th scope="col-1">Название ✎</th>
                    <th scope="col-1">Фото ✎</th>
                    <th scope="col-2">Описание ✎</th>
                    <th scope="col-1">Цена ✎</th>
                    <th scope="col-1"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($services as $el)
                  <tr class="serv">
                    <td class="{{$el->id}} serviceName">{{$el->serviceName}} </td>
                    <td class="{{$el->id}} serviceImg {{$el->serviceImg}}"><img src="{{ asset('/storage/'.$el->serviceImg)}}" alt=""></td>
                    <td class="{{$el->id}} serviceDescription">{{$el->serviceDescription}}</td>
                    <td class="{{$el->id}} servicePrice">{{$el->servicePrice}} руб.</td>
                    <td> <a class="text-center" style="font-size: 150%; color: white;" href="deleteServ/{{$el->id}}">🗑</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div id="mast" class="tabcontent">
              <div class="row">
                <div class="col-5">
                  <h4>Услуги</h4>
                </div>
                <div class="col-7">
                  <form name="search" action="" method="GET" class="searchForm">
                    {{csrf_field()}}
                    <div class="search-container">
                      <input type="search" class="form-control" name="queryUser" placeholder="Поиск">
                    </div>
                  </form>
                </div>
                <p class="pl-3 text-justify mt-3">
                  Поля таблицы, отмеченные знаком ✎ можно редактировать. Для редактирования необходимо совершить двойной щелчок мыши по изменяемому полю.
                  Для удаления записи нажмите на 🗑.
                </p>
              </div>
              <table class="table text-white mt-4">
                <thead>
                  <tr>
                    <th scope="col-1">ФИО ✎</th>
                    <th scope="col-1">Фото ✎</th>
                    <th scope="col-1">Телефон ✎</th>
                    <th scope="col-1">Описание ✎</th>
                    <th scope="col-1"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($masters as $el)
                  <tr class="serv">
                    <td class="{{$el->id}} masterFio">{{$el->masterFio}} </td>
                    <td class="{{$el->id}} masterImg {{$el->masterImg}}"><img src="{{ asset('/storage/'.$el->masterImg)}}" alt=""></td>
                    <td class="{{$el->id}} masterDescr">{{$el->masterDescr}}</td>
                    <td class="{{$el->id}} masterPhone">{{$el->masterPhone}}</td>
                    <td> <a class="text-center" style="font-size: 150%; color: white;" href="deleteMaster/{{$el->id}}">🗑</a></td>
                  </tr>
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
                <p>
                  <button class="button btn btn-outline-light btn-lg openForm ">Добавить запись</button>
                </p>
                <p class="pl-3 text-justify mt-3">
                  Поля таблицы, отмеченные знаком ✎ можно редактировать. Для редактирования необходимо совершить двойной щелчок мыши по изменяемому полю.
                  Для удаления записи нажмите на 🗑.
                </p>
              </div>

              <table class="table text-white mt-4">
                <thead>
                  <tr>
                    <th scope="col">Пользователь</th>
                    <th scope="col">Услуга ✎</th>
                    <th scope="col">Мастер ✎</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Дата ✎</th>
                    <th scope="col">Время ✎</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($schedules as $schedule)
                  <tr class="schedule">
                    <td>{{$schedule->name}}</br><span class="text-center" style="font-size: 75%;">({{$schedule->phone}})</span></td>
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
                    @if ($user->id == $schedule->user_id)
                    @if ($user->discount != 0)
                    @php $discountPrice = $service->servicePrice * ((100 - $user->discount) / 100) @endphp
                    <td> {{$discountPrice}} руб.<br><del>{{$service->servicePrice}} руб.</del> </td>
                    @else
                    <td> {{$service->servicePrice}} руб.</td>
                    @endif
                    @endif
                    @endforeach

                    @php $text = Carbon::parse($schedule->date)->format('d.m.Y');@endphp
                    <td class="{{$schedule->id}} date">{{$text}}</td>
                    @php $text = Carbon::parse($schedule->time)->format('H:i');@endphp
                    <td class="{{$schedule->id}} time">{{$text}}</td>
                    <td><a class="text-center" style="font-size: 150%; color: white;" href="deleteSchedule/{{$schedule->id}}">🗑</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div id="reviews" class="tabcontent">
              <div class="row">
                <div class="col-5">
                  <h4>Отзывы</h4>
                </div>
                <div class="col-7">
                  <form name="search" action="" method="GET" class="searchForm">
                    {{csrf_field()}}
                    <div class="search-container">
                      <input type="search" class="form-control" name="queryShcedule" placeholder="Поиск">
                    </div>
                  </form>
                </div>
                <p class="pl-3 text-justify mt-3">
                  Поля таблицы, отмеченные знаком ✎ можно редактировать. Для редактирования необходимо совершить двойной щелчок мыши по изменяемому полю.
                  Для удаления записи нажмите на 🗑.
                </p>
              </div>
              <h4 class="mt-3 mb-1">Неопубликованные:</h4>
              <table class="table text-white mt-4">
                <thead>
                  <tr>
                    <th scope="col">Имя</th>
                    <th scope="col">Телефон</th>
                    <th scope="col">Email</th>
                    <th scope="col">Оценка</th>
                    <th scope="col">Отзыв ✎</th>
                    <th scope="col">Опубликовать</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($reviews as $review)
                  @if($review->published == false)
                  <tr class="review {{$review->id}}">
                    <td>{{$review->name}}</td>
                    @if($review->phone != 0)
                    <td>{{$review->phone}}</td>
                    @else
                    <td>—</td>
                    @endif
                    @if($review->email != '0')
                    <td>{{$review->email}}</td>
                    @else
                    <td>—</td>
                    @endif
                    <td>{{$review->mark}}</td>
                    <td class="{{$review->id}} reviewText">{{$review->review}}</td>
                    <td class="check {{$review->id}}"><input type="checkbox" class="published" name="{{$review->id}}" value="publ" /></td>
                    <td><a class="text-center" style="font-size: 150%; color: white;" href="deleteReview/{{$review->id}}">🗑</a></td>
                  </tr>
                  @endif
                  @endforeach
                </tbody>
              </table>

              <h4 class="mt-5 mb-1">Опубликованные:</h4>
              <table class="table text-white mt-4">
                <thead>
                  <tr>
                    <th scope="col">Имя</th>
                    <th scope="col">Телефон</th>
                    <th scope="col">Email</th>
                    <th scope="col">Оценка</th>
                    <th scope="col">Отзыв</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody class="publReview">
                  @foreach ($reviews as $review)
                  @if($review->published == true)
                  <tr class="review">
                    <td>{{$review->name}}</td>
                    @if($review->phone != 0)
                    <td>{{$review->phone}}</td>
                    @else
                    <td>—</td>
                    @endif

                    @if($review->email != '0')
                    <td>{{$review->email}}</td>
                    @else
                    <td>—</td>
                    @endif
                    <td>{{$review->mark}}</td>
                    <td class="reviewText">{{$review->review}}</td>
                    <td><a class="text-center" style="font-size: 150%; color: white;" href="deleteReview/{{$review->id}}">🗑</a></td>
                  </tr>
                  @endif
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
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
  $('.published').change(function() {
    event.preventDefault();
    let review_id = $(this).attr("name");
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "/publReview",
      type: "POST",
      data: {
        review_id: review_id,
      },
      success(data) {
        alert('Отзыв опубликован!');
        $(`.check.${review_id}`).hide();
        $('.publReview').prepend('<tr>' + $(`.review.${review_id}`).html() + '</tr>');
        $(`.review.${review_id}`).hide();

      }
    });

  });
  $('.addServ').click(function() {

    event.preventDefault();
    let name = $('input[name="nameS"]').val(),
      description = $('textarea[name="descriptionS"]').val(),
      price = $('input[name="priceS"]').val();

    let fileInput = $('input[name="imgS"]');
    let files = fileInput[0].files;
    if (files.length > 0) {

      let file = files[0];
      let allowedFormats = ['jpg', 'jpeg', 'png']; // Define the allowed file formats

      let fileExtension = file.name.split('.').pop().toLowerCase();
      if (allowedFormats.indexOf(fileExtension) === -1) {
        alert('Неверный формат, пожалуйста, выберите другой файл!');
        return;
      }


      let formData = new FormData();
      formData.append('file', file);
      formData.append('name', name);
      formData.append('description', description);
      formData.append('price', price);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{url('addServ')}}",
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success(data) {
          if (data.status) {
            alert(data.message);
           location.reload();
          } else {
            alert(data.message);
          }
        }
      });
    }
  });

  $('.reviewText').dblclick(function(e) {
    let text = $(this).text();

    let id = $(this).attr('class').split(' ')[0];
    $(this).replaceWith('<td class="' + id + '"><textarea class="form-control repl">' + text + '</textarea></td> ');
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
          url: "{{url('updateReview')}}",
          type: 'post',
          data: {
            val: val,
            id: id,
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
  $('.serv > td').dblclick(function(e) {
    let text = $(this).text();
    let id = $(this).attr('class').split(' ')[0];
    let fieldName = $(this).attr('class').split(' ')[1];
    let path = $(this).attr('class').split(' ')[2];
    if (fieldName == 'serviceImg' || fieldName == 'masterImg') {
      $(this).replaceWith('<td class="' + id + ' ' + fieldName + ' ' + path + '">' +
        '<form action="" method="post" id="send" enctype="multipart/form-data"> {{ csrf_field() }}' +
        '<input type="file" class="form-control repl"  value="' + text + '" name="' + fieldName + '"> </form>' + '</td> ');
      $('.repl').focus();
      $('.repl').change(function(e) {
        let fileInput = $('.repl');
        let files = fileInput[0].files;
        if (files.length > 0) {

          let file = files[0];
          let allowedFormats = ['jpg', 'jpeg', 'png']; // Define the allowed file formats

          let fileExtension = file.name.split('.').pop().toLowerCase();
          if (allowedFormats.indexOf(fileExtension) === -1) {
            alert('Неверный формат, пожалуйста, выберите другой файл!');
            return;
          }


          let formData = new FormData();
          formData.append('file', file);
          formData.append('id', id);
          formData.append('fieldName', fieldName);
          e.preventDefault();
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            url: "{{url('upload')}}",
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success(data) {
              if (data.status) {
                alert(data.message);
                $(`.${id}.${fieldName}`).replaceWith('<td><img src="/storage/' + data.path + '" alt=""></td>');
              } else {
                alert(data.message);
                $(`.${id}.${fieldName}`).replaceWith('<td><img src=/storage/"' + files[0].name + '" alt=""></td>');

              }
            }
          });
        }
      });

    } else {
      $(this).replaceWith('<td class="' + id + ' ' + fieldName + '"><textarea class="form-control repl">' + text + '</textarea></td> ');
      $('.repl').focus();
      $('.repl').blur(function(e) {
        let val = $(this).val();
        alert('Поле успешно изменено!');
        $('.repl').replaceWith(val);
      });
    }
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
          time: time + ':00',
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
          time: time + ':00',
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
          thisTd.replaceWith('<td class="' + id + ' ' + fieldName + '"><select name="' + fieldName + '" class="repl" >' + data.message + ' </select></td>');
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
</script>