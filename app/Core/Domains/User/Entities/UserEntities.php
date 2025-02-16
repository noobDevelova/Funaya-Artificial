<?php

namespace App\Core\Domains\User\Entities;

class UserEntities
{
    public ?int $id;
    public ?string $username;
    public ?string $email;
    public ?string $password;
    public ?int $roleId;
    public ?string $phoneNumber;
    public ?string $roleName;
    public ?int $isActive;
    public ?string $lastLogin;
    public ?string $createdAt;
    public ?string $updatedAt;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->username = $data['username'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->phoneNumber = $data['phone_number'] ?? null;
        $this->password = $data['password'] ?? null;
        $this->roleId = $data['role_id'] ?? null;
        $this->roleName = $data['role_name'] ?? null;
        $this->isActive = $data['is_active'] ?? null;
        $this->lastLogin = $data['last_login'] ?? null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
    }
}
