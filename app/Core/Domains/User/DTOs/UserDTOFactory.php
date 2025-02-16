<?php

namespace App\Core\Domains\User\DTOs;

use App\Core\Domains\User\DTOs\Frame\UserRequest;
use App\Core\Domains\User\DTOs\Frame\UserResponse;
use App\Core\Domains\User\DTOs\Frame\UserRoleResponse;

interface UserDTOFactory
{
    public function createResponse(array $data): UserResponse;

    public function createRequest(array $data): UserRequest;

    public function createResponseRoles(array $data): UserRoleResponse;
}
