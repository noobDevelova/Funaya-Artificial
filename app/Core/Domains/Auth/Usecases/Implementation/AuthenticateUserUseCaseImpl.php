<?php

namespace App\Core\Domains\Auth\Usecases\Implementation;

use App\Core\Domains\Auth\DTOs\Frame\AuthRequest;
use App\Core\Domains\Auth\DTOs\Frame\AuthResponse;
use App\Core\Domains\Auth\Repositories\AuthRepository;
use App\Core\Domains\Auth\Usecases\AuthenticateUserUseCase;
use App\Core\Shared\Exception\BaseException;

class AuthenticateUserUseCaseImpl implements AuthenticateUserUseCase
{
    protected AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function execute(AuthRequest $loginRequest): AuthResponse | BaseException
    {
        try {
            return $this->authRepository->authenticate($loginRequest);
        } catch (BaseException $e) {
            throw new BaseException(
                $e->getErrorMessage(),
                $e->getErrorCode(),
                400
            );
        } catch (\Exception $e) {
            throw  new BaseException(
                $e->getMessage(),
                $e->getCode(),
                400
            );
        }
    }
}
