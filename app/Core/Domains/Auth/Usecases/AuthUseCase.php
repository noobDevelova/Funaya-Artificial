<?php

namespace App\Core\Domains\Auth\Usecases;

use App\Core\Domains\Auth\Repositories\AuthRepository;
use Exception;

class AuthUseCase
{
    protected $auth_repository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->auth_repository = $authRepository;
    }

    public function authenticate(string $email, string $password)
    {
        $user = $this->auth_repository->findByEmail($email);

        if (!$user) {
            throw new Exception('User not found');
        }

        // if (!password_verify($password, $user->password)) {
        //     throw new Exception('Invalid Credentials');
        // }

        if ($password != $user->password) {
            throw new Exception('Invalid Credentials');
        }

        return $user;
    }
}