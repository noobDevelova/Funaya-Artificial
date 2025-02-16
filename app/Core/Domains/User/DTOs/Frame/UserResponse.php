<?php

namespace App\Core\Domains\User\DTOs\Frame;

use App\Core\Domains\User\Entities\UserEntities;
use App\Core\Shared\Contracts\BaseDTOInterface;

interface UserResponseInteface extends BaseDTOInterface
{
    public function getObj(): object;
}

class UserResponse extends UserEntities implements UserResponseInteface
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->password = null;
    }

    public function getAssoc(): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'phoneNumber' => $this->phoneNumber,
            'role' => [
                'roleId' => $this->roleId,
                'roleName' => $this->roleName
            ],
            'isActive' => $this->isActive,
            'lastLogin' => $this->lastLogin,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt
        ];
    }

    public function getObj(): object
    {
        return json_decode(json_encode($this->getAssoc()));
    }
}
