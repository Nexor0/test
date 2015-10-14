<?php
/**
 * Created by PhpStorm.
 * User: nexor
 * Date: 12.10.15
 * Time: 17:17
 */

namespace App\Http\Controllers;

use App\Models;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;

class UsersController extends Controller
{
    /**
     * Профиль пользователя
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function profile()
    {
        if (!Auth::check())
        {
            return redirect('/');
        }
        $user = Auth::user();

        return view('profile', ['phone' => $user->phone, 'age' => $user->age]);
    }

    /**
     * Изменение данных в профиле пользователя
     * @param Authenticatable $user
     * @param Request $request
     */
    public function saveProfile(Authenticatable $user, Request $request)
    {
        if (!Auth::check())
        {
            return  false;
        }

        $v = Validator::make(
            ['age' => $request->input('age')],
            ['age' => 'required|integer|between:1,150']
        );
        if ($v->fails())
        {
            // Переданные данные не прошли проверку
            return response(array('msg' => 'Неверно указан возраст'))->header('Content-Type', 'application/json');
        }

        $user->age = $request->input('age');
        $user->save();

        return response(array('msg' => 'Профиль сохранён'))->header('Content-Type', 'application/json');

    }

    /**
     * Список пользователей
     * @return \Illuminate\View\View
     */
    public function usersList()
    {
        $users = Models\Users::paginate(10);
        return view('list', ['users' => $users]);
    }

    /**
     * Изменение проверочного ключа
     * @param Request $request
     */
    public function saveKey(Request $request)
    {
        $id = $request->input('user_id');
        $key = $request->input('user_key');
        $v = Validator::make(
            [
                'id' => $id,
                'user_key' => $key
            ],
            [
                'id' => 'required|integer',
                'user_key' => 'required|integer|between:0,9999'
            ]
        );
        if ($v->fails())
        {
            // Переданные данные не прошли проверку
            return response(array('msg' => 'Неправильный формат кода'))->header('Content-Type', 'application/json');
        }
        $id = $request->input('user_id');
        $key = $request->input('user_key');
        $user = Models\Users::find($id);
        $user->user_key = $key;
        $user->save();

        return response(array('msg' => 'Сохранено'))->header('Content-Type', 'application/json');
    }

    /**
     * Проверка ключа подтверждения
     * @param Request $request
     * @return mixed
     */
    public function checkKey(Request $request)
    {
        $phone = $request->input('phone');
        $key = $request->input('user_key');

        $users = Models\Users::where('phone', '=', $phone)->first();

        $v = Validator::make(
            [
                'user_key' => $key
            ],
            [
                'user_key' => 'required|integer|between:0,9999'
            ]
        );
        if ($v->fails())
        {
            // Переданные данные не прошли проверку
            return response(array('msg' => 'Неправильный формат кода'))->header('Content-Type', 'application/json');
        }

        if ($users && $users->user_key == $key) {
            Auth::loginUsingId($users->id, true);
            // Аутентификация прошла успешно
            return response(array('redirect' => 'users/profile'))->header('Content-Type', 'application/json');
        }

        return response(array('msg' => 'Проверочный код неверен!'))->header('Content-Type', 'application/json');

    }

    /**
     * Создание пользователя по номеру телефона
     * @param Request $request
     * @return mixed
     */
    public function setPhone(Request $request)
    {
        $phone = $request->input('phone');

        $v = Validator::make(
            ['phone' => $phone],
            [
                'phone' => ['required', 'regex:/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/']
            ]
        );

        if ($v->fails())
        {
            // Переданные данные не прошли проверку
            return response(array('msg' => 'Неправильно указан номер телефона'))
                ->header('Content-Type', 'application/json');
        }


        $users = Models\Users::firstOrCreate(['phone' => $phone]);

        if (empty($users->user_key)) {
            $users->setKey();
        }

        return response(array('result' => 'success'))->header('Content-Type', 'application/json');
    }
}
