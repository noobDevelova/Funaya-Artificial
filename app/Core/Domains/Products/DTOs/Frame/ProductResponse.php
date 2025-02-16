<?php

namespace App\Core\Domains\Products\DTOs\Frame;

use App\Core\Domains\Products\Entities\ProductEntities;
use App\Core\Shared\Contracts\BaseDTOInterface;
use PhpParser\Node\Expr\Cast\Object_;

interface ProductResponseInterface extends BaseDTOInterface
{
    public function getDetailData(bool $asObject): array | object;
    public function getIdentities(): array | object;
    public function getObj(): object;
}

class ProductResponse extends ProductEntities implements ProductResponseInterface
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
            'coverImage' => $this->coverImage,
            'price' => $this->price,
            'stockInfo' => [
                'currentStock' => $this->stock,
                'minimumStock' => $this->minimumStock
            ],
            'category' => [
                'id' => $this->categoryId,
                'name' => $this->categoryName
            ],
            'status' => [
                'showOnCatalog' => $this->showOnCatalog,
                'isActive' => $this->isActive,
                'deletedAt' => $this->deletedAt
            ],
        ];
    }

    public function getDetailData(bool $asObject = true): array | object
    {
        $data =  [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'price' => $this->price,
            'unit' => $this->unit,
            'coverImage' => $this->coverImage,
            'stockInfo' => [
                'currentStock' => $this->stock,
                'minimumStock' => $this->minimumStock
            ],
            'category' => [
                'id' => $this->categoryId,
                'name' => $this->categoryName
            ],
            'createdBy' => [
                'userId' => $this->createdBy,
                'username' => $this->createdByUsername,
            ],
            'modifiedBy' => [
                'updatedBy' => $this->updatedBy,
                'username' => $this->updatedByUsername,
            ],
            'status' => [
                'showOnCatalog' => $this->showOnCatalog,
                'isActive' => $this->isActive,
                'deletedAt' => $this->deletedAt
            ],
            'detail' => [
                'color' => $this->color,
                'size' => $this->size,
                'description' => $this->description,
                'material' => $this->material,
                'additionalInfo' => $this->additionalInfo
            ],
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt
        ];

        return $asObject ? json_decode(json_encode($data)) : $data;
    }

    public function getIdentities(bool $asObject = false): array | object
    {
        $product = [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'price' => $this->price,
            'stock' => $this->stock
        ];

        return $asObject ? json_decode(json_encode($product)) : $product;
    }

    public function getObj(): object
    {
        return json_decode(json_encode($this->getAssoc()));
    }
}
