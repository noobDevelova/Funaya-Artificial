<?php

namespace App\Core\Domains\Auth\Repositories\Model;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';

    protected $primary_key = 'id';

    protected $allowed_fields = ['username', 'email', 'password', 'role', 'first_name', 'last_name', 'phone_number', 'address'];

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}