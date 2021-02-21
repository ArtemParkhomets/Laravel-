@extends('admin/layout')
@section('content')
<body>
    <div class="container-xxl mt-2">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Новые заказы</a>
                <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Отправленные</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Номер заказа</th>
                        <th scope="col">Имя пользователя</th>
                        <th scope="col">Дата создания</th>
                        <th scope="col">Отредактирован</th>
                        <th scope="col">Сумма заказа</th>
                        <th scope="col">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ordersInProcess as $item)
                    <tr>
                        <form method="get" action="{{route('see.order.details', [$item->id, $item->total_price])}}">
                            <input type="hidden" value="{{$item->id}}">
                            <input type="hidden" value="{{$item->total_price}}">
                            <th scope="row"><button type="submit" class="btn btn-link">{{$item->id}}</button></th>
                        </form>
                        <td>{{$item->user->name}}</td>
                        <td>{{$item->created_at->format('d/m/Y')}}</td>
                        <td>{{$item->updated_at->format('d/m/Y')}}</td>
                        <td>{{$item->total_price}}</td>
                        <td>
                            <form action="{{route('sent.order',$item->id)}}" method="post">
                                @csrf
                                <input type="hidden" value="{{$item->id}}">
                                <button class="btn btn-success">Отправить</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Номер заказа</th>
                        <th scope="col">Имя пользователя</th>
                        <th scope="col">Дата создания</th>
                        <th scope="col">Отправлен</th>
                        <th scope="col">Сумма заказа</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ordersSent as $item)
                        <tr>
                            <th scope="row">{{$item->id}}</th>
                            <td>{{$item->user->name}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->updated_at}}</td>
                            <td>{{$item->total_price}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
@endsection
