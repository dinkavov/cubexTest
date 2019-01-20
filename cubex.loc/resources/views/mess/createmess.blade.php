@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route("home")}}" class="btn btn-success d-xs-inline-block d-sm-inline-block d-md-inline-block d-lg-inline-block d-xl-inline-block">В личный кабинет</a><br></br>
                <div class="card">
                    <div class="card-header">Создать заявку</div>

                        {!! Form::open(['action' => ['MessController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                        <div class="form-group">
                            {{ Form::label('messageTheme', 'Тема сообщения') }}
                            {{ Form::text('messageTheme', '', ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('message', 'Сообщение') }}
                            {{ Form::text('message', '', ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::file('file', ['class' => 'form-control']) }}
                        </div>

                        {{ Form::submit('Отправить', ['class' => 'btn btn-primary btn-lg']) }}
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
