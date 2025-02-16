<?php

namespace App\Core\Domains\Auth\Usecases\Implementation;

use App\Core\Domains\Auth\Repositories\AuthRepository;
use App\Core\Domains\Auth\Usecases\UnAuthenticateUserUseCase;

class UnAuthenticateUserUseCaseImpl implements UnAuthenticateUserUseCase
{
    protected $auth_repository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->auth_repository = $authRepository;
    }

    public function execute(int $userId): bool
    {
        return $this->auth_repository->unAuthenticate($userId);
    }
}
