<?php

namespace App\Core\Domains\User\Usecases\Implementation;

use App\Core\Domains\User\Usecases\DeleteUserUseCase;
use App\Core\Domains\User\Repositories\UserRepository;
use App\Core\Shared\Exception\BaseException;

class DeleteUserUseCaseImpl implements DeleteUserUseCase
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(int $id): bool | BaseException
    {
        try {
            return $this->userRepository->deleteUser($id);
        } catch (BaseException $e) {
            throw new BaseException($e->getMessage(), $e->getCode(), 400);
        } catch (\Exception $e) {
            throw new BaseException($e->getMessage(), $e->getCode(), 400);
        }
    }
}
