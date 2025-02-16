<?php

namespace App\Core\Domains\User\Usecases\Implementation;

use App\Core\Domains\User\Repositories\UserRepository;
use App\Core\Domains\User\Usecases\GetListUsersUseCase;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\BaseListResponse;

class GetListUsersUseCaseImpl implements GetListUsersUseCase
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(BaseListParams $params): BaseListResponse | BaseException
    {
        try {
            return $this->userRepository->getUsers($params);
        } catch (\Exception $e) {
            throw new BaseException(
                $e->getMessage(),
                $e->getCode(),
                400
            );
        }
    }
}
