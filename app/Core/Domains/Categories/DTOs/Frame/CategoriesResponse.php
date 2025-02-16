<?php

namespace App\Core\Domains\Categories\DTOs\Frame;

use App\Core\Domains\Categories\Entities\CategoriesEntities;
use App\Core\Shared\Contracts\BaseDTOInterface;


interface CategoriesResponseInt extends BaseDTOInterface
{
    public function getListAssoc(): array;
}

class CategoriesResponse extends CategoriesEntities implements CategoriesResponseInt
{
    public function __construct(array $data)
    {
        parent::__construct($data);
    }

    public function getAssoc(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }

    public function getListAssoc(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'productCount' => $this->productCount,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }
}
