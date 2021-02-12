@extends('layouts/header')
@section('content')
    <div class="container-xxl">
        <div class="row justify-content-center ">
            @foreach($categoryList as $cat)
                <form class="card m-2" style="width: 14rem;" action="">
                    <div >
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$cat->title}}</h5>
                            <p class="card-text">{{$cat->description}}</p>
                            <a href="#" class="btn btn-primary">Цинкануть</a>
                        </div>
                        <div>
                            <input type="hidden" name="id" value="{{$cat->id}}">
                        </div>
                    </div>
                </form>
            @endforeach
        </div>
    </div>
@endsection

