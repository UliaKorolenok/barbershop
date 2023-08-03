@extends('layouts.app')
@section('content')
<div class="contacts">
    <div class="background">
        <div class="background2">
            <div class="container">
                <div class="row">
                    <div class="col-7">
                        <div class="masterTitle">
                            <h1 class="display-3 beigeColor">Контакты</h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contactBlock">
        <div class="container">
            <div class="row">
                <div class="col-6 contactText">
                    <div class="title">
                        <h1 class="display-4 mb-4 beigeColor">Свяжитесь с нами</h1>
                    </div>
                    <div class="px-4 mb-2 margin">
                        <h1 class="display-6"> Адрес</h1>
                        <h1 class="display-5"> Г. Минск, пр. Независимости, 93</h1>
                        <h1 class="display-6"> Телефон </h1>
                        <h1 class="display-5"> +375447301493 </h1>
                        <h1 class="display-6"> График работы </h1>
                        <h1 class="display-5"> Понедельник-воскресенье с 10.00 до 21.00 </h1>
                    </div>
                    <button class="btn btn-header btn-outline-light btn-lg">Подробнее</button>
                </div>
                <div class="col-6 my-auto">
                    <div class="form">
                        <form method="POST" action='/contact' class="send" id="send" autocomplete="off" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <p class="msg"></p>

                            <div class="row mb-4">
                                <div class="input_item">
                                    <input type="text" name="name" placeholder="Имя *" require />
                                </div>
                            </div>
                            <div class="row my-4">
                                <div class="col-12">
                                    <div class="input_item">
                                        <input type="tel" name="phone" placeholder="Телефон *" require />
                                    </div>
                                </div>
                            </div>
                            <div class="row my-4">
                                <div class="col-12">
                                    <div class="input_item">
                                        <input type="email" name="email" placeholder="Email *" require />
                                    </div>
                                </div>
                            </div>
                            <div class="row my-4">
                                <div class="col-12">
                                    <div class="input_item">
                                        <textarea type="text" name="message" placeholder="Сообщение *" require></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="submit text-center">
                                <button class="btn btn-header btn-outline-light btn-lg">Отправить сообщение</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="map mt-5">
                    <div class="ymap" style="position:relative;overflow:hidden;">
                        <a href="https://yandex.by/maps/157/minsk/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Минск</a>
                        <a href="https://yandex.by/maps/157/minsk/?ll=27.555691%2C53.902735&utm_medium=mapframe&utm_source=maps&z=12" style="color:#eee;font-size:12px;position:absolute;top:14px;"></a>
                        <iframe src="https://yandex.by/map-widget/v1/?ll=27.555691%2C53.902735&z=12" width="1300" height="600" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('input[type="tel"]').mask('+375(00)000-00-00');
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
    $(".send").submit(function(event) {
        event.preventDefault();

        let successSendText = "Сообщение успешно отправлено";
        let errorSendText = "Сообщение не отправлено. Попробуйте еще раз!";
        let requiredFieldsText = "Пожалуйста, заполните все поля!";

        let message = $(this).find(".msg");

        let form = $("#" + $(this).attr("id"))[0];
        let fd = new FormData(form);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/contact",
            type: "POST",
            data: fd,
            processData: false,
            contentType: false,
            success: function success(res) {

                let respond = $.parseJSON(res);

                if (respond === "SUCCESS") {
                    message.text(successSendText).css("color", "#A59982");
                    setTimeout(() => {
                        message.text("");
                    }, 4000);
                } else if (respond === "NOTVALID") {
                    message.text(requiredFieldsText).css("color", "#d42121");
                    if ($(`input[name="name"]`).val() == '') {
                        $(`input[name="name"]`).addClass('error');
                    }
                    if ($(`textarea[name="message"]`).val() == '') {
                        $(`textarea[name="message"]`).addClass('error');
                    }
                    if ($(`input[name="phone"]`).val() == '') {
                        $(`input[name="phone"]`).addClass('error');
                    }
                    if ($(`input[name="email"]`).val() == '') {
                        $(`input[name="email"]`).addClass('error');
                    }
                    setTimeout(() => {
                        message.text("");
                        $('input[name="name"]').removeClass('error');
                        $('input[name="phone"]').removeClass('error');
                        $('input[name="email"]').removeClass('error');
                        $('textarea[name="message"]').removeClass('error');
                        message.text("");
                    }, 3000);
                } else {
                    message.text(errorSendText).css("color", "#d42121");
                    setTimeout(() => {
                        message.text("");
                    }, 4000);
                }
            }
        });
    });
</script>
@endsection