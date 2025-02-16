<?php

namespace App\Core\Domains\Sales\Repository\Model;

use CodeIgniter\Model;

class SalesItemsModel extends Model
{
    protected $table = 'sale_items';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'sale_id',
        'product_id',
        'quantity',
        'price',
        'total'
    ];

    protected $returnType = 'array';
}
