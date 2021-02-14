@extends('admin/adminlayout')
@section('content')
    <div class="container-xxl">
        <table class="table">
            <p class="mt-2">Заказ № </p>
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
    </div>


@endsection
