@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{route("home")}}" class="btn btn-success d-xs-inline-block d-sm-inline-block d-md-inline-block d-lg-inline-block d-xl-inline-block">В личный кабинет</a><br></br>
            <div class="panel panel-default">
                <div class="card">
                    <div class="card-body">

                    	{!! Form::open(['action' => ['ChatController@chat'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                        <div class="form-group">
                            {{ Form::label('message', 'Сообщение') }}
                            {{ Form::textarea('message', '', ['class' => 'form-control']) }}
                        </div>

                        {{ Form::submit('Отправить', ['class' => 'btn btn-primary btn-lg']) }}
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection