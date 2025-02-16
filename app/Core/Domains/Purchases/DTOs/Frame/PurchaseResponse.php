<?php

namespace App\Core\Domains\Purchases\DTOs\Frame;

use App\Core\Domains\Purchases\Entities\PurchasesEntities;

class PurchaseResponse extends PurchasesEntities
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    public function getListItems(bool $asObject = true): array | object
    {
        $data = [
            'purchaseId' => $this->id,
            'supplier' => [
                'id' => $this->supplierId,
                'name' => $this->supplierName
            ],
            'product' => [
                'id' => $this->productId,
                'name' => $this->productName,
                'category' => $this->productCategory,
                'image' => $this->productImage,
            ],
            'createdBy' => [
                'id' => $this->createdBy,
                'name' => $this->username
            ],
            'purchaseDetail' => [
                'quantity' => $this->quantity,
                'price' => $this->price,
                'total' => $this->total,
                'totalAmount' => $this->totalAmount
            ],
            'purchaseDate' => $this->purchaseDate,
            'createdAt' => $this->createdAt,
        ];

        return $asObject ? json_decode(json_encode($data)) : $data;
    }
}
