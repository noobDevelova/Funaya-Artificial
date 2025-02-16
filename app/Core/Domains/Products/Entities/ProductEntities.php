<?php

namespace App\Core\Domains\Products\Entities;

class ProductEntities
{
    public ?string $id;
    public ?string $name;
    public ?string $slug;
    public ?float $price;
    public ?int $stock;
    public ?int $minimumStock;
    public ?string $unit;
    public ?int $categoryId;
    public ?string $categoryName;
    public ?string $coverImage;
    public ?int $createdBy;
    public ?string $createdByUsername;
    public ?int $updatedBy;
    public ?string $updatedByUsername;
    public ?string $createdAt;
    public ?string $updatedAt;
    public ?int $showOnCatalog;
    public ?string $deletedAt;
    public ?int $isActive;
    public ?string $color;
    public ?string $size;
    public ?string $description;
    public ?string $material;
    public ?string $additionalInfo;
    public ?object $coverImageFile;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->slug = $data['slug'] ?? null;
        $this->price = $data['price'] ?? null;
        $this->stock = $data['stock'] ?? null;
        $this->minimumStock = $data['minimum_stock'] ?? null;
        $this->unit = $data['unit'] ?? 'pcs';
        $this->categoryId = $data['category_id'] ?? null;
        $this->categoryName = $data['category_name'] ?? null;
        $this->coverImage = $data['cover_image'] ?? null;
        $this->createdBy = $data['created_by'] ?? null;
        $this->updatedBy = $data['updated_by'] ?? null;
        $this->createdByUsername = $data['created_by_username'] ?? null;
        $this->updatedByUsername = $data['updated_by_username'] ?? null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->showOnCatalog = $data['show_on_catalog'] ?? 0;
        $this->deletedAt = $data['deleted_at'] ?? null;
        $this->isActive = $data['is_active'] ?? 0;
        $this->color = $data['color'] ?? null;
        $this->size = $data['size'] ?? null;
        $this->material = $data['material'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->additionalInfo = $data['additional_info'] ?? null;
        $this->coverImageFile = $data['cover_image_file'] ?? null;
    }
}
