<?php

namespace App\Core\Domains\User\Entities;

class UserRolesEntities
{
    public int $id;
    public string $roleName;
    public string $createdAt;
    public string $updatedAt;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'];
        $this->roleName = $data['role_name'];
        $this->createdAt = $data['created_at'];
        $this->updatedAt = $data['updated_at'];
    }
}
