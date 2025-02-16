<?php

namespace App\Core\Domains\Auth\Repositories;

use App\Core\Domains\Auth\DTOs\Frame\AuthRequest;
use App\Core\Domains\Auth\DTOs\Frame\AuthResponse;
use App\Core\Shared\Exception\BaseException;

interface AuthRepository
{
    public function authenticate(AuthRequest $loginRequest): AuthResponse | BaseException;
    public function unAuthenticate(int $userId): bool;
}
