<?php

namespace App\Core\Domains\Auth\DTOs;

use App\Core\Domains\Auth\DTOs\Frame\AuthRequest;
use App\Core\Domains\Auth\DTOs\Frame\AuthResponse;

interface AuthDTOFactory
{
    public function createRequest(array $data): AuthRequest;

    public function createResponse(array $data): AuthResponse;
}
