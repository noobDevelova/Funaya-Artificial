<?php

namespace  App\Core\Domains\Categories\Entities;

class CategoriesEntities
{
    public ?int $id;
    public string $name;
    public ?string $slug;
    public string $description;
    public ?int $productCount;
    public ?string $createdAt;
    public ?string $updatedAt;
    public ?string $deletedAt;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'];
        $this->slug = $data['slug'] ?? null;
        $this->description = $data['description'];
        $this->productCount = $data['product_count'] ?? null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->deletedAt = $data['deleted_at'] ?? null;
    }
}
