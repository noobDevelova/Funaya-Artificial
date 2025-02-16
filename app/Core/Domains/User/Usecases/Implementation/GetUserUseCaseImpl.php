<?php

namespace App\Core\Domains\User\Usecases\Implementation;

use App\Core\Domains\User\DTOs\Frame\UserResponse;
use App\Core\Domains\User\Repositories\UserRepository;
use App\Core\Domains\User\Usecases\GetUserUseCase;
use App\Core\Shared\Exception\BaseException;

class GetUserUseCaseImpl implements GetUserUseCase
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(int $id): UserResponse | BaseException
    {
        try {
            return $this->userRepository->getUserById($id);
        } catch (BaseException $e) {
            throw new BaseException($e->getMessage(), $e->getCode(), 400);
        } catch (\Exception $e) {
            throw new BaseException($e->getMessage(), $e->getCode(), 400);
        }
    }
}
