<?php

namespace App\Core\Domains\Auth\DTOs\Implementation;

use App\Core\Domains\Auth\DTOs\AuthDTOFactory;
use App\Core\Domains\Auth\DTOs\Frame\AuthRequest;
use App\Core\Domains\Auth\DTOs\Frame\AuthResponse;

class AuthDTOFactoryImpl implements AuthDTOFactory
{
    public function createRequest(array $data): AuthRequest
    {
        return new AuthRequest($data);
    }

    public function createResponse(array $data): AuthResponse
    {
        return new AuthResponse($data);
    }
}
