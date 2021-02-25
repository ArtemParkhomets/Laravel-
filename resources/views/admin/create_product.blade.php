@extends('admin.layout')
@section('content')
    <div class="container-xxl mt-3">
        <div class="row">
            <form method="post" action="{{route('create.product')}}">
                @method('POST')
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Название товара</label>
                    <input name="title" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Описание товара</label>
                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Назначьте цену</span>
                    <input name="price" placeholder="Цена" type="number" aria-label="Price" class="form-control">
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Категория</label>
                    <select name="categories_id" class="form-select" id="inputGroupSelect01">
                        @foreach($categoryList as $cat)
                        <option value="{{$cat->id}}">{{$cat->title}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
