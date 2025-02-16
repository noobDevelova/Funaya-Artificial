<?php

namespace App\Core\Domains\User\Repositories\Model;

use CodeIgniter\Model;

class RolesModel extends Model
{
    protected $table = 'roles';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'role_name',
        'created_at',
        'updated_at',
    ];

    protected $returnType = 'array';
}
