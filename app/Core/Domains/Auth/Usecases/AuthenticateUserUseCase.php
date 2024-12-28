<?php

namespace App\Core\Domains\Auth\Usecases;

use App\Core\Domains\Auth\DTOs\LoginRequest;
use App\Core\Domains\Auth\Repositories\AuthRepositoryInterface;
use Exception;

class AuthenticateUserUseCase
{
    protected $auth_repository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->auth_repository = $authRepository;
    }

    public function execute(LoginRequest $loginRequest)
    {
        $user = $this->auth_repository->findByEmail($loginRequest->email);

        if (!$user) {
            throw new Exception('User not found');
        }

        if (!password_verify($loginRequest->password, $user->password)) {
            throw new Exception('Invalid Credentials');
        }

        return $user;
    }
}