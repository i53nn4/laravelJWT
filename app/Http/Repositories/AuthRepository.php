<?php

namespace App\Http\Repositories;

use App\Models\User;

class AuthRepository
{
    /**
     * @param array $params
     * @return mixed
     */
    public function get(array $params)
    {
        return User::where('login', $params['login'])->first();
    }
}
