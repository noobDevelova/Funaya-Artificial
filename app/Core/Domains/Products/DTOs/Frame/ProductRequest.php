<?php

namespace App\Core\Domains\Products\DTOs\Frame;

use App\Core\Domains\Products\Entities\ProductEntities;
use App\Core\Shared\Contracts\BaseDTOInterface;

interface ProductRequestInterface extends BaseDTOInterface
{
    public function getDetailAssoc(): array;
    public function getImageFile(): object;
}

class ProductRequest extends ProductEntities implements ProductRequestInterface
{
    public function __construct(array $data)
    {
        parent::__construct($data);
    }

    public function getAssoc(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'price' => $this->price,
            'minimum_stock' => $this->minimumStock,
            'cover_image' => $this->coverImage,
            'category_id' => $this->categoryId,
            'updated_by' => $this->updatedBy,
            'created_by' => $this->createdBy,
        ];
    }

    public function getImageFile(): object
    {
        return $this->coverImageFile;
    }

    public function getDetailAssoc(): array
    {
        return [
            'color' => $this->color,
            'size' => $this->size,
            'material' => $this->material,
            'description' => $this->description,
            'additional_info' => $this->additionalInfo
        ];
    }
}
