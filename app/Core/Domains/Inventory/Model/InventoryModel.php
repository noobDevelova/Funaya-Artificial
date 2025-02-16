<?php

namespace App\Core\Domains\Inventory\Model;

use CodeIgniter\Model;

class InventoryModel extends Model
{
    protected $table = 'inventory_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'product_id',
        'activity_type',
        'quantity',
        'remarks',
        'logged_by',
        'logged_at',
    ];
    protected $returnType = 'array';
}
