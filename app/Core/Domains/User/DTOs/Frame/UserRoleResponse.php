<?php

namespace App\Core\Domains\User\DTOs\Frame;

use App\Core\Domains\User\Entities\UserRolesEntities;
use App\Core\Shared\Contracts\BaseDTOInterface;

class UserRoleResponse extends UserRolesEntities implements BaseDTOInterface
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    public function getAssoc(): array
    {
        return [
            'id' => $this->id,
            'roleName' => $this->roleName,
        ];
    }
}
