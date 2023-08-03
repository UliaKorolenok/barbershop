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
                            <form class="mb-1" method="POST" action="{{ route('login') }}">
                                <h1 class='beigeColor'>&bull; Войти &bull;</h1>
                                <div class="underline pt-2 mb-3">
                                </div>
                                <P class="msg none"></P>
                                @csrf
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
                                    <input class="submit" type="submit" value="Войти" id="form_button" />
                                </div>
                                <p class="text-center mt-4 mb-0"><a class ="nav-link pp" href="{{ route('register') }}">У меня нет аккаунта, регистрация!</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('input[name="password"]').change(function(e) {
        e.preventDefault();
        let email = $('input[name="email"]').val(),
            password = $('input[name="password"]').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{url('checkUser')}}",
            type: 'POST',
            data: {
                email: email,
                password: password,
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
                        $(`p[class="errorT ` + field + `"]`).remove();
                        $(`input[name="${field}"]`).after('<p class = "errorT ' + field + '">' + data.message + '</p>');
                    });
                }
            }
        });
    });

    $('input[name="email"]').change(function(e) {
        e.preventDefault();
        let email = $('input[name="email"]').val(),
            password = $('input[name="password"]').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{url('checkUser')}}",
            type: 'POST',
            data: {
                email: email,
                password: password,
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
                        $(`p[class="errorT ` + field + `"]`).remove();
                        $(`input[name="${field}"]`).after('<p class = "errorT ' + field + '">' + data.message + '</p>');
                    });
                }
            }
        });
    });
</script>
@endsection