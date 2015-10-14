<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';

    protected $guarded = ['id'];

    /**
     * Установка ключа
     */
    public function setKey() {

        $this->user_key = rand(1000, 9999);

        // Отправка ключа
        $this->sendKey();

        $this->save();
    }


    /**
     * Отправка ключа пользователю
     */
    protected function sendKey() {
        return true;
    }

}
