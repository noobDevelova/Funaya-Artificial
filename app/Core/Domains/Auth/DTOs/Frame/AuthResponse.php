<?php

namespace App\Core\Domains\Auth\DTOs\Frame;

use App\Core\Domains\Auth\Entities\AuthEntities;
use App\Core\Shared\Contracts\BaseDTOInterface;

class AuthResponse extends AuthEntities implements BaseDTOInterface
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    public function getAssoc(): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'role' => $this->role_id
        ];
    }
}
