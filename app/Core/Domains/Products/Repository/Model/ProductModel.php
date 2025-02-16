<?php

namespace App\Core\Domains\Products\Repository\Model;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'minimum_stock',
        'unit',
        'category_id',
        'cover_image',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'show_on_catalog',
        'is_active'
    ];

    protected $returnType = 'array';

    protected $useTimestamps = true;

    protected $useSoftDeletes = true;

    public function softDelete(int $id): bool
    {
        log_message('debug', print_r($id, true));

        $data = ['deleted_at' => date('Y-m-d H:i:s')];
        return $this->update($id, $data);
    }
}
