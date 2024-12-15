<?php

namespace App\Core\Domains\Auth\Repositories;

use App\Core\Domains\Auth\Entities\UserEntities;
use App\Core\Domains\Auth\Repositories\Model\UserModel;

class AuthRepository
{
    protected $user_model;

    public function __construct()
    {
        $this->user_model = new UserModel();
    }

    public function findByEmail(string $email)
    {
        $user_data = $this->user_model->getUserByEmail($email);

        if (!$user_data) {
            return null;
        }

        return new UserEntities((array) $user_data);
    }
}