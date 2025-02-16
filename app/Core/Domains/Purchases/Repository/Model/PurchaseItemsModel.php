<?php

namespace App\Core\Domains\Purchases\Repository\Model;

use CodeIgniter\Model;

class PurchaseItemsModel extends Model
{
    protected $table = 'purchase_items';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'purchase_id',
        'product_id',
        'quantity',
        'price',
        'total'
    ];
}
