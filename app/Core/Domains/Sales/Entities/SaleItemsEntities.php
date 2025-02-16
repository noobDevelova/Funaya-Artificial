<?php

namespace App\Core\Domains\Sales\Entities;

class SaleItemsEntities
{
    public ?int $id;
    public ?int $saleId;
    public ?int $productId;
    public ?int $quantity;
    public ?int $price;
    public ?int $total;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->saleId = $data['sale_id'] ?? null;
        $this->productId = $data['product_id'] ?? null;
        $this->quantity = $data['quantity'] ?? null;
        $this->price = $data['price'] ?? null;
        $this->total = $data['total'] ?? null;
    }

    public function setSaleId(int $saleId)
    {
        $this->saleId = $saleId;
    }

    public function toArray(): array
    {
        return [
            'sale_id' => $this->saleId,
            'product_id' => $this->productId,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'total' => $this->total
        ];
    }
}
