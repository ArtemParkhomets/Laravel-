@extends('layouts/header')
@section('content')
<body>
    <div class="container-xxl">
        <h1>Ваша корзина:</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Название</th>
                <th scope="col">Цена</th>
                <th scope="col">Количество</th>
                <th scope="col">Удалить из корзины</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <th scope="row">{{$item->name}}</th>
                    <td>{{$item->price}}</td>
                    <td>
                        <form method="post" action="{{route('edit.cart', $item->id)}}">
                            @csrf
                            <input type="hidden" value="{{$item->id}}">
                            <input type="number" name="quantity" value="{{$item->quantity}}">
                            <button type="submit" class="btn btn-primary">Пересчитать</button>
                        </form>
                    </td>
                    <td><a href="">Удалить</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <p class="">Итого:</p>
            <div class="mt-2 "><a class="btn btn-success" href="">Оформить заказ</a></div>
        </div>

    </div>
</body>
@endsection
