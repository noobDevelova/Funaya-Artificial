<?php

namespace App\Core\Domains\Auth\Repositories\Model;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'username',
        'email',
        'password',
        'role_id',
        'phone_number',
        'last_login',
        'created_at',
        'updated_at'
    ];
    public function getUserByEmail($email)
    {
        return $this->select('users.*, roles.role_name')
            ->join('roles', 'roles.id = users.role_id')
            ->where('users.email', $email)
            ->first();
    }
}