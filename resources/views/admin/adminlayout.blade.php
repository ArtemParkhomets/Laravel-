<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Админ панель</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</head>
<body>
    <div class="container-xxl">
        <div class="row">
            <nav class="navbar navbar-dark bg-dark">
                <div class="container-fluid">
                    <h3 class="text-white">Действуй!</h3>
                    <a class="navbar-brand" href="{{route('admin.products')}}">Товары</a>
                    <a class="navbar-brand" href="{{route('admin.categories')}}">Категории</a>
                    <a class="navbar-brand" href="{{route('home')}}">Пользователи</a>
                    <a class="navbar-brand" href="{{route('home')}}">Заказы</a>
                    <a class="navbar-brand" href="{{route('logout')}}">Выйти</a>
                </div>
            </nav>
        </div>
    </div>

</body>
</html>
@yield('content')
