<?php

namespace App\Core\Domains\Purchases\Entities;

class PurchasesEntities
{
    public ?int $id;
    public ?int $supplierId;
    public ?int $productId;
    public ?string $purchaseDate;
    public ?int $totalAmount;
    public ?int $createdBy;
    public ?string $createdAt;
    public ?int $quantity;
    public ?int $price;
    public ?int $total;
    public ?string $supplierName;
    public ?string $productName;
    public ?string $productCategory;
    public ?string $productImage;
    public ?string $username;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->supplierId = $data['supplier_id'] ?? null;
        $this->productId = $data['product_id'] ?? null;
        $this->purchaseDate = $data['purchase_date'] ?? null;
        $this->productName = $data['product_name'] ?? null;
        $this->productCategory = $data['product_category'] ?? null;
        $this->productImage = $data['product_image'] ?? null;
        $this->supplierName = $data['supplier_name'] ?? null;
        $this->totalAmount = $data['total_amount'] ?? null;
        $this->createdBy = $data['created_by'] ?? null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->quantity = $data['quantity'] ?? null;
        $this->price = $data['price'] ?? null;
        $this->total = $data['total'] ?? null;
        $this->username = $data['username'] ?? null;
    }

    public function getTotalPrice()
    {
        return $this->price * $this->quantity;
    }
}
