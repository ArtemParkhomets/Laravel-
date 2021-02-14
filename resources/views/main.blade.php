@extends('layouts/header')
@section('content')

    <div class="container-xxl">
        <div class="row">
            <div class="col-3 mt-2 bg-light">
                <h6>Фильтр товаров</h6>
                <form action="{{route('home')}}" method="get">
                    <nav class="nav flex-column">
                        <input class="form-control me-2" name="search" type="search" placeholder="Поиск по товарам" aria-label="Search">
                        <p>Выберите категорию:</p>
                        @foreach($categories as $cat)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="categories_id[]" value="{{$cat->id}}" >
                            <label class="form-check-label" for="flexCheckDefault">
                                {{$cat->title}}
                            </label>
                        </div>
                        @endforeach
                        <p>Отфильтруйте по цене:</p>
                        <div class="row">
                            <div class="col">
                                <input type="text" name="price_from" value="{{request()->price_from}}" class="form-control" placeholder="Цена от" aria-label="First name">
                            </div>
                            <div class="col">
                                <input type="text" name="price_to" value="{{request()->price_to}}" class="form-control" placeholder="Цена до" aria-label="Last name">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Тыць</button>
                        <a class="btn btn-primary mt-3" href="{{route('home')}}">Сброс</a>
                    </nav>
                </form>
            </div>
            <div class="col-9 bg-light mt-2">
                <div class="row justify-content-center">
                    @foreach($products as $product)
                    <div class="col-4">
                        <div class="card mt-2">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{$product->title}}</h5>
                                <p class="card-text">{{$product->description}}</p>
                                <h6 class="card-title">{{$product->category->title}}</h6>
                                <h6>Цена: {{$product->price}} руб.</h6>
                                <a href="#" class="btn btn-primary">Подробнее</a>
                                <form action="{{route('add.cart', $product->id)}}" method="post">
                                    @csrf
                                    <input type="hidden" value="{{$product->id}}">
                                    @auth()
                                    <input class="form-control m-1" type="number" min="1" name="quantity" value="<?php if(empty(request()->quantity)){echo '1';}else{echo $product->quantity;}?>">
                                    <button class="btn btn-success" type="submit">Беру!</button>
                                    @endauth
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                    <div class="mt-2">
                        {{ $products->withQueryString()->links() }}
                    </div>
                </div>
        </div>
    </div>
@endsection

