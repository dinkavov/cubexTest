@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route("mess.index") }}" class="btn btn-success d-xs-inline-block d-sm-inline-block d-md-inline-block d-lg-inline-block d-xl-inline-block">Вернуться к заявкам</a><br></br>
            <div class="panel panel-default">
                <div class="card">
                    <div class="card-body">
                        <div id="messagesCard" class="card" data-requestId="{{ $request_id }}" style="margin-bottom: 20px">
                          <div class="card-header">
                            Переписка
                          </div>
                          <div class="card-body">
                            @if(count($messages) > 0)
                                <div class="chatScroll">
                                    @foreach($messages as $message)
                                        @if($manager)
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @if($message->isManager)
                                                        <div class="float-right">
                                                            <a class="nav-link disabled" href="#"><b>Вы:</b> {{ $message->text }}</a>
                                                        </div>
                                                    @else
                                                        <div class="float-left">
                                                            <a class="nav-link disabled" href="#"><b>Пользователь:</b> {{ $message->text }}</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @if($message->isManager)
                                                        <div class="float-left">
                                                            <a class="nav-link disabled" href="#"><b>Менеджер:</b> {{ $message->text }}</a>
                                                        </div>
                                                    @else
                                                        <div class="float-right">
                                                            <a class="nav-link disabled" href="#"><b>Вы:</b> {{ $message->text }}</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif    
                                    @endforeach
                                </div>
                            @endif
                          </div>
                        </div>

                    	{!! Form::open(['action' => ['ChatController@sendMessage'], 'method' => 'POST', 'id' => 'managerChatForm']) !!}

                        <div class="form-group">
                            {{ Form::textarea('message', '', ['id' => 'messageField', 'class' => 'form-control', 'rows' => 3, 'cols' => 3, 'placeholder' => 'Сообщение...', 'required' => true]) }}
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