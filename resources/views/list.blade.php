@extends('layout')

@section('title', 'Пользователи')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Пользователи</div>
        <div class="panel-body">
            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            <table class="table table-hover">
                <tr>
                    <th>Дата и время регистрации</th>
                    <th>Телефон</th>
                    <th>Имя</th>
                    <th colspan="2">Ключ</th>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->created_at }}</td>
                        <td class="phone">{{ $user->phone }}</td>
                        <td></td>
                        <td>
                            <input type="email" class="form-control" id="user-key-{{ $user->id }}" value="{{ $user->user_key }}">
                        </td>
                        <td>
                            <input type="hidden" class="user-id"  value="{{ $user->id }}">
                            <a class="btn btn-default save-user-key" role="button">Сохранить</a>
                        </td>
                    </tr>
                @endforeach
            </table>
            {!! $users->render() !!}
        </div>
    </div>
@stop
