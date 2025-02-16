<?php

namespace App\Core\Domains\Supplier\Repository\Model;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table = 'suppliers';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'slug',
        'contact_person',
        'phone',
        'email',
        'address',
        'created_at',
        'updated_at'
    ];

    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
