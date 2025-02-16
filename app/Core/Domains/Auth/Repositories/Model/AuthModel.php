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
        'last_login',
    ];
}
