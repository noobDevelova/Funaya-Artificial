<?php

namespace App\Core\Domains\User\DTOs;

class CreateUserRequest
{
    public $username;
    public $email;
    public $phone_number;
    public $password;


    public function __construct(array $data = [])
    {
        $this->username = $data['username'];
        $this->email = $data['email'];
        $this->phone_number = $data['phone_number'];
        $this->password = $data['password'];
    }
}