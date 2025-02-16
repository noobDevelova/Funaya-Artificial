<?php

namespace App\Core\Domains\Products\Repository\Model;

use CodeIgniter\Model;

class ProductDetailModel extends Model
{
    protected $table = 'product_details';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'product_id',
        'color',
        'size',
        'material',
        'description',
        'additional_info'
    ];

    protected $returnType = 'array';
}
