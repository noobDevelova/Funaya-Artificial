<?php

namespace App\Core\Domains\Auth\Repositories;

use App\Core\Domains\Auth\Entities\AuthEntities;
use App\Core\Domains\Auth\Repositories\Model\AuthModel;

class AuthRepository
{
    protected $authModel;

    public function __construct()
    {
        $this->authModel = new AuthModel();
    }

    public function findByEmail(string $email)
    {
        $user_data = $this->authModel->getUserByEmail($email);

        if (!$user_data) {
            return null;
        }

        return new AuthEntities((array) $user_data);
    }
}