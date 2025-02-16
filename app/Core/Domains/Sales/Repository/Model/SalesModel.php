<?php

namespace App\Core\Domains\Sales\Repository\Model;

use CodeIgniter\Model;

class SalesModel extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'sale_date',
        'total_amount',
        'created_by'
    ];

    protected $returnType = 'array';
}
