@extends('layouts/header')
@section('content')

    <div class="container-xxl">
        <div class="row">
            <div class="col-3 mt-2 bg-light">
                <h6>Фильтр товаров</h6>
                <form action="{{route('filter')}}" method="get">
                    <nav class="nav flex-column">
                        <p>Выберите категорию:</p>
                        @foreach($categories as $cat)
                        <div class="form-check">

                            <input class="form-check-input" name="categories_id[]" type="checkbox" value="{{$cat->id}}" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                {{$cat->title}}
                            </label>

                        </div>@endforeach
                        <p>Отфильтруйте по цене:</p>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Цена от" aria-label="First name">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Цена до" aria-label="Last name">
                            </div>
                        </div>


                        <button class="btn btn-info mt-3">Тыць</button>
                    </nav>
                </form>
            </div>
                <div class="col-9 bg-light mt-2">
                    <div class="row justify-content-center">
                        @foreach($result as $product)
                            <div class="col-4">
                                <div class="card mt-2">
                                    <img src="..." class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$product->title}}</h5>
                                        <p class="card-text">{{$product->description}}</p>
                                        <h6 class="card-title">{{$product->categories_id}}</h6>
                                        <h6>Цена: {{$product->price}} руб.</h6>
                                        <a href="#" class="btn btn-primary">Подробнее</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>



@endsection
