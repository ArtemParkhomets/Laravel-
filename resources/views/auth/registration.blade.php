@extends('layouts/header')
@section('content')
<div class="container-xxl  bg-light mt-3">
    <div class="row justify-content-center">
        <form class="w-50" action="{{route('save_user')}}" method="post">
            @method('POST')
            @csrf
            <div class="mb-3 mt-3">
                <label for="exampleInputPassword1" class="form-label">Введите имя</label>
                <input name="name" value="{{old('name')}}" type="text" class="form-control" id="exampleInputPassword1">
                @error('name')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Введите Email</label>
                <input name="email" value="{{old('email')}}" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                @error('email')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Введите пароль</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                @error('password')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Повторите пароль</label>
                <input name="confirm_password" type="password" class="form-control" id="exampleInputPassword1">
                @error('confirm_password')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="row justify-content-center">
                <button type="submit" class="btn btn-primary w-50 mb-3">Зарегистрироваться!</button>
            </div>
        </form>
    </div>
</div>
@endsection
