@extends('admin.layout')
@section('content')
    <div class="container-xxl mt-5">
        <div class="row">
            <div class="col-9">
                <table class="table table-striped ">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Название</th>
                        <th scope="col">Описание</th>
                        <th scope="col">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categoryList as $cat)
                    <tr>
                        <th scope="row">{{$cat->id}}</th>
                        <td>{{$cat->title}}</td>
                        <td>{{$cat->description}}</td>
                        <td><div class="row">
                                <div class="col-6">
                                    <form action="{{route('admin.delete', $cat->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">☠</button>
                                    </form>
                                </div>
                                <div class="col-6">
                                    <form action="{{route('admin.edit',$cat->id)}}" method="GET">
                                        <button type="submit" class="btn btn-primary">✎</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="container-xxl">
                    {{ $categoryList->links() }}
                </div>
            </div>
            <div class="col-3">
                <form class="justify-content-center" action="{{route('create.category')}}" method="post">
                    @method('POST')
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Название категории:</label>
                        <input name="title" type="text" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Описание категории:</label>
                        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Создать категорию</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
