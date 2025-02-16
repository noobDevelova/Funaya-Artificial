<?php

namespace App\Core\Domains\Purchases\Repository\Model;

use CodeIgniter\Model;

class PurchasesModel extends Model
{
    protected $table = 'purchases';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'supplier_id',
        'purchase_date',
        'total_amount',
        'created_by',
        'created_at',
    ];

    protected $returnType = 'array';
}
