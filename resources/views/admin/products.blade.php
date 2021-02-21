@extends('admin.layout')
@section('content')
<div class="container-xxl">
    <div class="row">
        <table class="table mt-3">
            <thead>
            <tr>
                <th scope="col"><a class="btn btn-dark " href="{{route('admin.create.product')}}">Создать</a></th>
                <th scope="col">Название</th>
                <th scope="col">Описание</th>
                <th scope="col">Цена</th>
                <th scope="col">Категория</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($result as $prod)
                <tr>
                <th scope="row">{{$prod->id}}</th>
                <td>{{$prod->title}}</td>
                <td>{{$prod->description}}</td>
                <td>{{$prod->price}}</td>
                <td>{{$prod->category->title}}</td>
                <td><div class="row">
                        <div class="col-6">
                            <form action="{{url('/admin/delete', $prod->id)}}" method="post">
                                @method('POST')
                                @csrf
                                <button type="submit" class="btn btn-danger">☠</button>
                            </form>
                        </div>
                        <div class="col-6">
                            <form action="{{route('edit.prod', $prod->id)}}" method="GET">
                                <button type="submit" class="btn btn-primary">✎</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="container-xxl">
    {{$result->links()}}
</div>
@endsection
