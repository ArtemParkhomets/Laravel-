@extends('layouts/header')
@section('content')
<div class="container-xxl bg-light mt-3">
    <div class="row justify-content-center">
        <div class="col-6">
            <form class="" action="{{route('login')}}" method="post">
                @method('POST')
                @csrf
                <div class="mb-3 mt-3">
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
                <div class="row justify-content-center mb-3">
                    <button type="submit" class="w-25 btn btn-primary">Войти</button>
                    @error('formError')
                    <div class="alert alert-danger mt-3">{{$message}}</div>
                    @enderror
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

