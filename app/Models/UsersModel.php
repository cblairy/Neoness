<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';

    protected $allowedFields = ['email','password','firstname','name','phone','sex','birthday','size','weight','target_weight','BMI', 'registration_date'];

    public function getUser($user = false)
    {
        if ($user === false) {
            return $this->findAll();
        }

        return $this->where(['email' => $user])->first();
    }
}