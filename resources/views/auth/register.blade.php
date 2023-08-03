@extends('layouts.app')

@section('content')
<style>
     .pp{
       font-variant: small-caps !important;
       font-size: 150% !important;
    }
    .pp:hover{
        color: #A59982 !important; 
    }
    </style>
<div class="background">
    <div class="background2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="reg ">
                        

                        <div class="">
                            <form class="mb-1" method="POST" action="{{ route('register') }}">
                                @csrf
                                <h1 class='beigeColor'>&bull; Регистрация &bull;</h1>
                        <div class="underline pt-2 mb-3">
                        </div>
                                <div class="">
                                    <input id="name" type="text" placeholder="Введите имя" name="name" value="{{ old('name') }}" required autocomplete="name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="">

                                    <input id="phone" type="tel" placeholder="Введите номер телефона" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="">
                                    <input id="email" type="email" placeholder="Введите email" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class=" ">
                                    <input id="password" type="password" placeholder="Введите пароль" name="password" required autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                                <div class="submit text-center mt-4">
                                    <input class="submit" type="submit" value="Регистрация" id="form_button" />
                                </div>
                                <p class="text-center mt-4 mb-0"><a class ="nav-link pp" href="{{ route('login') }}">У меня уже есть аккаунт!</a></p>
                            </form>
                        </div>
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
            url: "{{url('checkPhone')}}",
            type: 'POST',
            data: {
                phone: phone,
            },
            success(data) {
                if (data.status) {
                    $('input[name="phone"]').removeClass('error');
                    $(`p[class="errorT phone"]`).remove();
                    $('.submit').prop('disabled', false);
                } else {
                    data.fields.forEach(function(field) {
                        $('.submit').prop('disabled', true);
                        $(`input[name="${field}"]`).addClass('error');
                        $(`p[class="errorT `+field+`"]`).remove();
                        $(`input[name="${field}"]`).after('<p class = "errorT '+field+'">'+data.message+'</p>');
                    });
                }
            }
        });
    });
    $('input[name="password"]').change(function(e) {
        e.preventDefault();
        let pass = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{url('checkPassword')}}",
            type: 'POST',
            data: {
                pass: pass,
            },
            success(data) {
                if (data.status) {
                    $('input[name="password"]').removeClass('error');
                    $(`p[class="errorT password"]`).remove();
                    $('.submit').prop('disabled', false);
                } else {
                    data.fields.forEach(function(field) {
                        $('.submit').prop('disabled', true);
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
            url: "{{url('checkEmail')}}",
            type: 'POST',
            data: {
                email: email,
            },
            success(data) {
                if (data.status) {
                    $('input[name="email"]').removeClass('error');
                    $(`p[class="errorT email"]`).remove();
                    $('.submit').prop('disabled', false);
                } else {
                    data.fields.forEach(function(field) {
                        $('.submit').prop('disabled', true);
                        $(`input[name="${field}"]`).addClass('error');
                        $(`p[class="errorT `+field+`"]`).remove();
                        $(`input[name="${field}"]`).after('<p class = "errorT '+field+'">'+data.message+'</p>');
                    });
                }
            }
        });
    });
</script>
@endsection