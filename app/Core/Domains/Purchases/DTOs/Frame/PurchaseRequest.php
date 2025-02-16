<?php

namespace App\Core\Domains\Purchases\DTOs\Frame;

use App\Core\Domains\Purchases\Entities\PurchasesEntities;
use App\Core\Shared\Contracts\BaseDTOInterface;

interface PurchaseRequestInterface extends BaseDTOInterface
{
    public function getItemAssoc(): array;
}

class PurchaseRequest extends PurchasesEntities implements PurchaseRequestInterface
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    public function getAssoc(): array
    {
        return [
            'supplier_id' => $this->supplierId,
            'total_amount' => $this->getTotalPrice(),
            'created_by' => $this->createdBy,
        ];
    }

    public function getItemAssoc(): array
    {
        return [
            'product_id' => $this->productId,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'total' => $this->getTotalPrice()
        ];
    }
}
