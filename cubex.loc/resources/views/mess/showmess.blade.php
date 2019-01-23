@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{route("home")}}" class="btn btn-success d-xs-inline-block d-sm-inline-block d-md-inline-block d-lg-inline-block d-xl-inline-block">В личный кабинет</a><br></br>
            @include('includes.messages')
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderless table-hover">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>{{ $mess->id }}</th>
                            </tr>
                            
                            <tr>
                                <th>Имя пользователя</th>
                                <th>{{ $mess->user->name }}</th>
                            </tr>

                            <tr>
                                <th>Тема</th>
                                <th>{{ $mess->theme }}</th>
                            </tr>

                            <tr>
                                <th>Сообщение</th>
                                <th>{{ $mess->message }}</th>
                            </tr>

                            <tr>
                                <th>Прикрепленный файл</th>
                                <th>
                                    <a href="/storage/files/{{ $mess->file  }}" target="_blank">{{ $mess->file }}</a>
                                </th>
                            </tr>

                            <tr>
                                <th>Дата создания</th>
                                <th>{{ $mess->created_at }}</th>
                            </tr>
                        </tbody>
                    </table>
                    {!! Form::open(['action' => ['MessController@markAsViewed', 'messId' => $mess->id], 'method' => 'POST']) !!}
                    {{ Form::hidden('_method', 'PUT') }}
                    {{ Form::submit('Пометить прочитанным', ['class' => 'btn btn-primary btn-lg']) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
