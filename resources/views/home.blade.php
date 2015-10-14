@extends('layout')

@section('title', 'Регистрация пользователя')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Регистрация пользователя</div>
        <div class="panel-body">
            <div id="form-wrap-phone">
                {!! Form::open(
                            array(
                                'route' => 'users/setPhone',
                                'method' => 'post',
                                'id' => 'form-phone-send',
                                'class' => 'form-signin'
                            )
                            )
                        !!}
                <div class="form-group">
                    {!! Form::label( 'phone', 'Введите номер телефона:' ) !!}
                    {!! Form::text( 'phone', '', array(
                        'id' => 'phone',
                        'placeholder' => '+7 926 575 48 42',
                        'maxlength' => 30,
                        'required' => true,
                        'class' => 'form-control',
                    ) ) !!}
                </div>
                {!! Form::submit( 'Далее', array(
                    'id' => 'btn-add-setting',
                    'class' => 'btn btn-primary',
                ) ) !!}

                {!! Form::close() !!}
            </div>
            <div id="form-wrap-key" style="display: none;">
                {!! Form::open(
                            array(
                                'route' => 'users/checkKey',
                                'method' => 'post',
                                'id' => 'form-key-check',
                                'maxlength' => 30,
                                'class' => 'form-signin'
                            )
                            )
                        !!}
                <div class="form-group">
                    {!! Form::label( 'user_key', 'Введите проверочный код:' ) !!}
                    {!! Form::text( 'user_key', '', array(
                        'id' => 'user_key',
                        'maxlength' => 4,
                        'pattern' => '[0-9]{4}',
                        'required' => true,
                        'class' => 'form-control',
                    ) ) !!}
                </div>
                {!! Form::submit( 'Далее', array(
                    'id' => 'btn-add-setting',
                    'class' => 'btn btn-primary',
                ) ) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop