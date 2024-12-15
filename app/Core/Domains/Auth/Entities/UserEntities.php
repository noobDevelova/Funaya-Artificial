<?php

namespace App\Core\Domains\Auth\Entities;

class UserEntities
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $role;
    public $first_name;
    public $last_name;
    public $phone_number;
    public $address;
    public $created_at;
    public $updated_at;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->username = $data['username'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->password = $data['password'] ?? null;
        $this->role = $data['role'] ?? null;
        $this->first_name = $data['first_name'] ?? null;
        $this->last_name = $data['last_name'] ?? null;
        $this->phone_number = $data['phone_number'] ?? null;
        $this->address = $data['address'] ?? null;
        $this->created_at = $data['created_at'] ?? null;
        $this->updated_at = $data['updated_at'] ?? null;
    }
}