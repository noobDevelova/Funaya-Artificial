<?php

namespace App\Core\Domains\Auth\Usecases;

use App\Core\Domains\Auth\Repositories\AuthRepositoryInterface;

class UnAuthenticateUserUseCase
{
    protected $auth_repository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->auth_repository = $authRepository;
    }

    public function execute(int $userId)
    {
        $reauth = $this->auth_repository->updateLastLogin($userId);

        return $reauth;
    }
}