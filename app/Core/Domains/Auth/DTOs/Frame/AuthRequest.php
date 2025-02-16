<?php

namespace App\Core\Domains\Auth\DTOs\Frame;

use App\Core\Domains\Auth\Entities\AuthEntities;
use App\Core\Shared\Contracts\BaseDTOInterface;

class AuthRequest extends AuthEntities implements BaseDTOInterface
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    public function getAssoc(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password
        ];
    }
}
