@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @include('includes.messages')

            <div class="card">
                <div class="card-header">Личный кабинет</div>

                <div class="card-body">
                    <div class="flex-center">
                        @auth
                        @if(Auth::user()->isAdmin)
                        <a href="{{ route("mess.index") }}" class="btn btn-info">
                            Просмотреть заявки
                        </a>
                        @else
                        <a href="{{ route("mess.create") }}" class="btn btn-info">
                            Создать заявку
                        </a>

                        <a href="{{ route("mess.ushow") }}" class="btn btn-info">
                            Мои заявки
                        </a> 
                        @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
