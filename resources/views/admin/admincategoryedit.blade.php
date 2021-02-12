@extends('admin/adminlayout')
@section('content')
    <div class="container-xxl mt-5">
        <div class="row justify-content-center">
            <div class="col-6">
                <form action="{{route('update.category', $cat_edit->id)}}" method="post">
                    @method('PATCH')
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Название категории</label>
                        <input name="title" value="{{$cat_edit->title}}" type="text" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Описание категории</label>
                        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$cat_edit->description}}</textarea>
                    </div>
                    <div>
                        <input type="hidden" name="id" value="{{$cat_edit->id}}">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    </div>
                </form>
            </div>
        </div>
    </div>





@endsection
