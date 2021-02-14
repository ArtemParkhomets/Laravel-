@extends('admin/adminlayout')
@section('content')
<body>
    <div class="container-xxl mt-2">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
                <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
                <a class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
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
                        <form method="get" action="{{route('see.order.details', $item->id)}}">
                            <input type="hidden" value="{{$item->id}}">
                            <th scope="row"><button type="submit" class="btn btn-link">{{$item->id}}</button></th>
                        </form>
                        <td>{{$item->user->name}}</td>
                        <td>{{$item->created_at->format('d/m/Y')}}</td>
                        <td>{{$item->updated_at->format('d/m/Y')}}</td>
                        <td>{{$item->totalPrice}}</td>
                        <td>
                            <form action="{{route('sent.order',$item->id)}}" method="post">
                                @csrf
                                <input type="hidden" value="{{$item->id}}">
                                <button class="btn btn-succes">Отправить</button>
                            </form>
                            <form action="">
                                @csrf
                                <input type="hidden" value="{{$item->id}}">
                                <button class="btn btn-succes">Отменить</button>
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
                        <th scope="col">Отредактирован</th>
                        <th scope="col">Сумма заказа</th>
                        <th scope="col">Доставка</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ordersSent as $item)
                        <tr>
                            <th scope="row">{{$item->id}}</th>
                            <td>{{$item->user->name}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->updated_at}}</td>
                            <td>{{$item->totalPrice}}</td>
                            <td>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

@endsection
