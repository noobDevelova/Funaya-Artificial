<?php

namespace App\Core\Domains\User\Usecases;

use App\Core\Domains\User\DTOs\Frame\UserRequest;
use App\Core\Domains\User\DTOs\Frame\UserResponse;
use App\Core\Domains\User\Repositories\UserRepository;
use App\Core\Domains\User\Usecases\Implementation\CreateUserUseCaseImpl;
use App\Core\Domains\User\Usecases\Implementation\GetListRolesUseCaseImpl;
use App\Core\Domains\User\Usecases\Implementation\GetListUsersUseCaseImpl;
use App\Core\Domains\User\Usecases\Implementation\GetUserUseCaseImpl;
use App\Core\Domains\User\Usecases\Implementation\UpdateUserUseCaseImpl;
use App\Core\Domains\User\Usecases\Implementation\ToggleActiveUserUseCaseImpl;
use App\Core\Domains\User\Usecases\Implementation\DeleteUserUseCaseImpl;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\BaseListResponse;

interface GetListUsersUseCase
{
    public function execute(BaseListParams $params): BaseListResponse | BaseException;
}

interface GetListRolesUseCase
{
    public function execute(): BaseListResponse | BaseException;
}

interface CreateUserUseCase
{
    public function execute(UserRequest $request): bool|BaseException;
}

interface GetUserUseCase
{
    public function execute(int $id): UserResponse | BaseException;
}

interface UpdateUserUseCase
{
    public function execute(UserRequest $request): bool|BaseException;
}

interface ToggleActiveUserUseCase
{
    public function execute(int $id): bool|BaseException;
}

interface DeleteUserUseCase
{
    public function execute(int $id): bool|BaseException;
}

class UserUsecases
{
    public static function getListUsers(
        UserRepository $userRepository
    ): GetListUsersUseCase {
        return new GetListUsersUseCaseImpl($userRepository);
    }

    public static function getListRoles(
        UserRepository $userRepository
    ): GetListRolesUseCase {
        return new GetListRolesUseCaseImpl($userRepository);
    }

    public static function createUser(
        UserRepository $userRepository
    ): CreateUserUseCase {
        return new CreateUserUseCaseImpl($userRepository);
    }

    public static function getUser(
        UserRepository $userRepository
    ): GetUserUseCase {
        return new GetUserUseCaseImpl($userRepository);
    }

    public static function updateUser(
        UserRepository $userRepository
    ): UpdateUserUseCase {
        return new UpdateUserUseCaseImpl($userRepository);
    }

    public static function toggleActiveUser(
        UserRepository $userRepository
    ): ToggleActiveUserUseCase {
        return new ToggleActiveUserUseCaseImpl($userRepository);
    }

    public static function deleteUser(
        UserRepository $userRepository
    ): DeleteUserUseCase {
        return new DeleteUserUseCaseImpl($userRepository);
    }
}
