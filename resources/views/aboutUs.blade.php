@extends('layouts.app')
@section('content')
@php use Carbon\Carbon; @endphp

<div class="reviews">
    <div class="background">
        <div class="background2">
            <div class="container"><div class="row">
                <div class="col-7 colTit">
                    <div class="masterTitle">
                        <h1 class="display-3 beigeColor">Отзывы</h1>
                    </div>
                    <div class="text">
                        <h1 class="display-6">Здесь вы можете прочитать отзывы наших посетителей, а также оставить свой!</h1>
                    </div>
                </div>
            </div></div>
        </div>
    </div>
    <div class="bgMaster mt-4">
       <div class="container">
       <div class="row">
            @foreach($reviews as $el)
            <div class="col-3">
                <div class=" card-body">
                    <div class="cardBack">
                        <div class="row">
                            <div class="col-5">
                                <h5 class="card-title">{{$el->name}} </h5>
                            </div>
                            <div class="col-7 text-right">
                                <h5 class="card-title"> @for ($i=0; $i < $el->mark; $i++) ★ @endfor </h5>
                            </div>
                        </div>
                        @php $text = Carbon::parse($el->date)->format('d.m.Y');@endphp 
                        <p class="card-text">{{$text}}</p>
                        <p class="card-text">{{$el->review}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="masterTitle mt-4 text-center">
            <h1 class="display-4 beigeColor">Оставьте отзыв о барбершопе</h1>
        </div>
        <div class="form">
            <form method="POST" class="sendReview" id="sendReview" autocomplete="off" enctype="multipart/form-data">
                {{csrf_field()}}
                <P class="msg"></P>
                <div class="row markS">
                    <div class="col-12">
                        <div class="input_item">
                            <h3>
                                Ваша оценка
                            </h3>
                            <div class="rating-area">
                                <input type="radio" id="star-5" name="mark" value="5">
                                <label for="star-5" title="Оценка «5»"></label>
                                <input type="radio" id="star-4" name="mark" value="4">
                                <label for="star-4" title="Оценка «4»"></label>
                                <input type="radio" id="star-3" name="mark" value="3">
                                <label for="star-3" title="Оценка «3»"></label>
                                <input type="radio" id="star-2" name="mark" value="2">
                                <label for="star-2" title="Оценка «2»"></label>
                                <input type="radio" id="star-1" name="mark" value="1">
                                <label for="star-1" title="Оценка «1»"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input_item">
                            <input type="text" name="name" placeholder="Имя *" require />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input_item">
                            <input type="tel" name="phone" placeholder="Телефон" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input_item">
                            <input type="email" name="email" placeholder="Email" />
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-12">
                        <div class="input_item">
                            <textarea type="text" name="review" placeholder="Отзыв *" require></textarea>
                        </div>
                    </div>
                </div>
                <div class="submit text-center">
                    <button class="btn btn-header btn-outline-light btn-lg">Оставить отзыв</button>
                </div>
            </form>
        </div>
       </div>

    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
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
    $(".sendReview").submit(function(event) {
        event.preventDefault();
        let successSendText = "Спасибо за Ваш отзыв, он будет опубликован после проверки модератором!";
        let errorSendText = "Отзыв не отправлен. Попробуйте еще раз!";
        let requiredFieldsText = "Пожалуйста, заполните все поля!";
        let requiredFieldMark = "Пожалуйста, поставьте оценку!";

        let message = $(this).find(".msg");

        let form = $("#" + $(this).attr("id"))[0];
        let fd = new FormData(form);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/sendReview",
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
                    }, 5000);
                } else if (respond === "NOTVALID") {
                    message.text(requiredFieldsText).css("color", "#d42121");
                    if($(`input[name="name"]`).val()==''){
                        $(`input[name="name"]`).addClass('error');
                    }
                    if($(`textarea[name="review"]`).val()==''){
                        $(`textarea[name="review"]`).addClass('error');
                    }
                    setTimeout(() => {
                        message.text("");
                        $('input[name="name"]').removeClass('error');
                        $('textarea[name="review"]').removeClass('error');
                        message.text("");
                    }, 3000);
                } else if (respond === "NOTVALIDMark") {
                    message.text(requiredFieldMark).css("color", "#d42121");
                    setTimeout(() => {
                        message.text("");
                    }, 4000);
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