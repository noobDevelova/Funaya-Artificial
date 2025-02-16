<?php

namespace App\Core\Domains\Sales\Entities;

class SalesEntities
{
    public ?int $id;
    public ?string $saleDate;
    public ?int $totalAmount;
    public ?int $createdBy;
    public array $salesItems;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->saleDate = $data['sale_date'] ?? null;
        $this->totalAmount = $data['total_amount'] ?? null;
        $this->createdBy = $data['created_by'] ?? null;

        $this->salesItems = isset($data['sales_items'])
            ? array_map(fn($item) => new SaleItemsEntities($item), $data['sales_items'])
            : [];
    }

    public function setSaleIdForItems(int $saleId): void
    {
        foreach ($this->salesItems as $item) {
            $item->setSaleId($saleId);
        }
    }

    public function getTotalAmount(): int
    {
        return array_reduce($this->salesItems, fn($total, $item) => $total + $item->total, 0);
    }
}
