<?php

namespace App\Core\Domains\Auth\Entities;

class AuthEntities
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $role_id;
    public $last_login;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->username = $data['username'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->password = $data['password'] ?? null;
        $this->role_id = $data['role_id'] ?? null;
        $this->last_login = $data['last_login'] ?? null;
    }
}