<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/app.css">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Главная</title>
        <header>
            <div class="container-xxl">
                <div class="row nav">
                    <nav class="justify-content-between navbar navbar-light bg-light">
                        <div class="">
                            <a class="nav-link text-dark" href="{{route('home')}}"><h2>Laravel❤</h2></a>
                        </div>
                        <div class="nav">
                        @guest()
                        <a class="nav-link btn btn-success" href="{{route('login')}}">Войти</a>
                        <a class="nav-link" href="{{route('reg_v')}}"> <small>Или зарегистрироваться</small></a>
                        @endguest
                        @auth()
                        <a class="nav-link" href="{{route('logout')}}"><button class="btn btn-danger" type="submit">Выйти из меня</button></a>
                        <a class="nav-link" href="{{route('cart')}}"><button class="btn btn-warning" type="submit">Корзина
                            <div class="badge bg-danger p-1">{{\Cart::session(auth()->id())->getContent()->count()}}</div>
                        </button></a>
                        @endauth
                        </div>
                    </nav>
                </div>
            </div>
        </header>
</head>
@yield('content')

