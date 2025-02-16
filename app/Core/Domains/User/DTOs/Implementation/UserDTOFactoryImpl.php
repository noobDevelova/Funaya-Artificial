<?php

namespace App\Core\Domains\User\DTOs\Implementation;

use App\Core\Domains\User\DTOs\Frame\UserRequest;
use App\Core\Domains\User\DTOs\Frame\UserResponse;
use App\Core\Domains\User\DTOs\Frame\UserRoleResponse;
use App\Core\Domains\User\DTOs\UserDTOFactory;

class UserDTOFactoryImpl implements UserDTOFactory
{
    public function createRequest(array $data): UserRequest
    {
        return new UserRequest($data);
    }

    public function createResponse(array $data): UserResponse
    {
        return new UserResponse($data);
    }

    public function createResponseRoles(array $data): UserRoleResponse
    {
        return new UserRoleResponse($data);
    }
}
