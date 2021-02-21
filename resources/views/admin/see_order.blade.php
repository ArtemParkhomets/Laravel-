@extends('admin.layout')
@section('content')
    <div class="container-xxl">
        <table class="table">
            <h3 class="mt-2">Заказ № {{$id}}</h3>
            <thead>
            <tr>
                <th scope="col">Название</th>
                <th scope="col">Цена</th>
                <th scope="col">Количество</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order as $item)
                <tr>
                    <th scope="row">{{$item->product->title}}</th>
                    <td>{{$item->product_price}}</td>
                    <td>{{$item->product_quantity}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <p class="">Итого: {{$totalPrice}}</p>
            <a class="btn btn-success" href="{{route('admin.orders')}}">Назад</a>
        </div>
    </div>
@endsection
