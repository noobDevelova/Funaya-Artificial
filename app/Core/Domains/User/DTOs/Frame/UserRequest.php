<?php

namespace App\Core\Domains\User\DTOs\Frame;

use App\Core\Domains\User\Entities\UserEntities;
use App\Core\Shared\Contracts\BaseDTOInterface;

class UserRequest extends UserEntities implements BaseDTOInterface
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    public function getAssoc(): array
    {
        return [
            'username' => $this->username,
            'email' => $this->email,
            'phone_number' => $this->phoneNumber,
            'password' => $this->password,
            'role_id' => $this->roleId,
        ];
    }

    public function getUpdateAssoc(): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'phone_number' => $this->phoneNumber,
            'role_id' => $this->roleId,
        ];
    }
}
