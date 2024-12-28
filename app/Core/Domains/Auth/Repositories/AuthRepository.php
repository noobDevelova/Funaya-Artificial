<?php

namespace App\Core\Domains\Auth\Repositories;

use App\Core\Domains\Auth\Entities\AuthEntities;
use App\Core\Domains\Auth\Repositories\Model\AuthModel;

interface AuthRepositoryInterface
{
    public function findByEmail(string $email): ?AuthEntities;
    public function updateLastLogin(int $userId): bool;
}

class AuthRepository implements AuthRepositoryInterface
{
    protected $authModel;

    public function __construct()
    {
        $this->authModel = new AuthModel();
    }

    public function findByEmail(string $email): ?AuthEntities
    {
        $user_data = $this->authModel->getUserByEmail($email);

        if (!$user_data) {
            return null;
        }

        return new AuthEntities((array) $user_data);
    }

    public function updateLastLogin(int $userId): bool
    {
        return $this->authModel->update($userId, ['last_login' => date('Y-m-d H:i:s')]);
    }
}