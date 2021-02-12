<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
{{--<link rel="stylesheet" href="resources/css/style.css">--}}
<div class="container-xxl justify-content-center">
    <div class="col-6">
        <form class="forma" action="{{route('login')}}" method="post">
            @method('POST')
            @csrf
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
            <button type="submit" class="btn btn-primary">Submit</button>
            @error('formError')
            <div class="alert alert-danger mt-1">{{$message}}</div>
            @enderror
        </form>
    </div>
</div>

