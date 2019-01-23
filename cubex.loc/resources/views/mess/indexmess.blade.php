@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{route("home")}}" class="btn btn-success d-xs-inline-block d-sm-inline-block d-md-inline-block d-lg-inline-block d-xl-inline-block">В личный кабинет</a><br></br>
            <div class="panel panel-default">
                <div class="card">
                    <div class="card-body">

                        @if(count($mess) >= 1)
                        <table class="table table-hover" style="width:100%">
                            <thead class="thead-light">
                                <tr>
                                    <th>Id</th>
                                    <th>Тема</th>
                                    <th>Имя клиента</th>
                                    <th>Просмотрено</th>
                                    <th>Время создания</th>
                                    <th></th>
                                </tr>
                            </thead>

                            @foreach($mess as $mes)
                            <tr>
                                <td>{{ $mes->id }}</td>
                                <td>{{ $mes->theme }}</td>
                                <td>{{ $mes->user->name }}</td>
                                <td>{{ $mes->isViewed ? 'Да' : 'Нет'}}</td>
                                <td>{{ $mes->created_at }}</td>
                                <td style="white-space: nowrap">
                                    <a href="{{route("mess.show", ['id' => $mes->id])}}" class="btn btn-success d-xs-inline-block d-sm-inline-block d-md-inline-block d-lg-inline-block d-xl-inline-block">Просмотреть</a>
                                </td>
                            </tr>
                            @endforeach
                        </table>

                        <div class="float-right">
                            <?= $mess->links() ?>
                        </div>
                        
                        @else
                        <div class="alert alert-primary" role="alert">
                            Заявок нет
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection