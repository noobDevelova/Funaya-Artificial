<?php

namespace App\Core\Domains\Auth\Usecases;

use App\Core\Domains\Auth\DTOs\Frame\AuthRequest;
use App\Core\Domains\Auth\DTOs\Frame\AuthResponse;
use App\Core\Domains\Auth\Repositories\AuthRepository;
use App\Core\Domains\Auth\Usecases\Implementation\AuthenticateUserUseCaseImpl;
use App\Core\Domains\Auth\Usecases\Implementation\UnAuthenticateUserUseCaseImpl;
use App\Core\Shared\Exception\BaseException;

interface AuthenticateUserUseCase
{
    public function execute(AuthRequest $loginRequest): AuthResponse|BaseException;
}

interface UnAuthenticateUserUseCase
{
    public function execute(int $userId): bool;
}


class AuthUsecases
{
    public static function createAuth(
        AuthRepository $authRepository
    ): AuthenticateUserUseCase {
        return new AuthenticateUserUseCaseImpl($authRepository);
    }

    public static function deleteAuth(
        AuthRepository $authRepository
    ): UnAuthenticateUserUseCase {
        return new UnAuthenticateUserUseCaseImpl($authRepository);
    }
}
