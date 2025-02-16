<?php

namespace App\Core\Domains\User\Repositories;

use App\Core\Domains\User\DTOs\Frame\UserRequest;
use App\Core\Domains\User\DTOs\Frame\UserResponse;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\BaseListResponse;

interface UserRepository
{
    public function getUsers(BaseListParams $params): BaseListResponse;

    public function getRoles(): BaseListResponse;

    public function createUser(UserRequest $request): bool|BaseException;

    public function getUserById(int $id): UserResponse | BaseException;

    public function updateUser(UserRequest $request): bool|BaseException;

    public function toggleActiveUser(int $id): bool|BaseException;

    public function deleteUser(int $id): bool|BaseException;
}
