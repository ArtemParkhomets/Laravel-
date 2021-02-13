@extends('layouts/header')
@section('content')
<body>
    <div class="container-xxl">
        <h1>Ваша корзина:</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Название</th>
                <th scope="col">Цена за шт.</th>
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
                            <div class="input-group w-50">
                                <input type="hidden" value="{{$item->id}}">
                                <input type="number" min="1" class="form-control" name="quantity" value="{{$item->quantity}}">
                                <button class="btn btn-outline-secondary" type="submit" >Пересчитать</button>
                            </div>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="{{route('remove.cart', $item->id)}}">
                            @csrf
                            <input type="hidden" value="{{$item->id}}">
                            <button class="btn btn-outline-danger" type="submit">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
            <form method="post" class="d-flex justify-content-between" action="{{route('createOrder.cart')}}">
                <p class="">Итого: {{\Cart::session(auth()->id())->getTotal()}}</p>
                <input type="hidden" value="">
                <button class="btn btn-success " type="submit">Оформить заказ</button>
            </form>
        </div>
    </div>
</body>
    @php dd(\Cart::session(auth()->id())->getContent()) @endphp
@endsection
