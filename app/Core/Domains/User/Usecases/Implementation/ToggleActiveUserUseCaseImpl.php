<?php

namespace App\Core\Domains\User\Usecases\Implementation;

use App\Core\Domains\User\Usecases\ToggleActiveUserUseCase;
use App\Core\Domains\User\Repositories\UserRepository;
use App\Core\Shared\Exception\BaseException;

class ToggleActiveUserUseCaseImpl implements ToggleActiveUserUseCase
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(int $id): bool | BaseException
    {
        try {
            return $this->userRepository->toggleActiveUser($id);
        } catch (BaseException $e) {
            throw new BaseException($e->getMessage(), $e->getCode(), 400);
        } catch (\Exception $e) {
            throw new BaseException($e->getMessage(), $e->getCode(), 400);
        }
    }
}
