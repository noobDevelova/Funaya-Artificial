<?php

namespace App\Core\Domains\Auth\Entities;

class AuthEntities
{
    public ?int $id;
    public ?string $username;
    public ?string $email;
    public ?string $password;
    public ?int $role_id;
    public ?string $last_login;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->username = $data['username'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->password = $data['password'] ?? null;
        $this->role_id = $data['role_id'] ?? null;
        $this->last_login = $data['last_login'] ?? null;
    }
}
