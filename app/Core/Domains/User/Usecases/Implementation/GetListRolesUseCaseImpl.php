<?php

namespace App\Core\Domains\User\Usecases\Implementation;

use App\Core\Domains\User\Repositories\UserRepository;
use App\Core\Domains\User\Usecases\GetListRolesUseCase;
use App\Core\Shared\Http\BaseListResponse;
use App\Core\Shared\Exception\BaseException;

class GetListRolesUseCaseImpl implements GetListRolesUseCase
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(): BaseListResponse|BaseException
    {
        try {
            return $this->userRepository->getRoles();
        } catch (\Exception $e) {
            throw new BaseException(
                $e->getMessage(),
                $e->getCode(),
                400
            );
        }
    }
}
