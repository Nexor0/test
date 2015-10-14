@extends('layout')

@section('title', 'Профиль')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Профиль</div>
        <div class="panel-body">
            <h2>{!! $phone !!}</h2>
            <div id="form-wrap-profile">
                {!! Form::open(
                            array(
                                'route' => 'users/saveProfile',
                                'method' => 'post',
                                'id' => 'form-profile',
                                'class' => 'form-signin'
                            )
                            )
                        !!}
                <div class="form-group">
                    {!! Form::label( 'age', 'Ваш возраст:' ) !!}
                    {!! Form::text( 'age', $age, array(
                        'id' => 'age',
                        'maxlength' => 3,
                        'required' => true,
                        'class' => 'form-control',
                    ) ) !!}
                </div>
                {!! Form::submit( 'Сохранить', array(
                    'id' => 'btn-add-setting',
                    'class' => 'btn btn-primary',
                ) ) !!}

                {!! Form::close() !!}
            </div>
            <a href="{{ url('/logout')}}">Выйти</a>
        </div>
    </div>
@stop
