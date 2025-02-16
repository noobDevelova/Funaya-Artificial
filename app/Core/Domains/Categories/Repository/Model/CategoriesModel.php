<?php

namespace App\Core\Domains\Categories\Repository\Model;

use CodeIgniter\Model;

class CategoriesModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'slug',
        'description',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    public function softDelete($id): bool
    {
        $data = ['deleted_at' => date('Y-m-d H:i:s')];
        return $this->update($id, $data);
    }
}
