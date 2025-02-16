<?php

namespace App\Core\Domains\User\Repositories\Model;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'username',
        'email',
        'password',
        'role_id',
        'phone_number',
        'is_active',
        'last_login',
        'created_at',
        'updated_at'
    ];

    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
