<?php

namespace App\Core\Domains\Supplier\Entities;


class SupplierEntities
{
    public ?int $id;
    public ?string $name;
    public ?string $slug;
    public ?string $contactPerson;
    public ?string $phone;
    public ?string $email;
    public ?string $address;
    public ?string $createdAt;
    public ?string $updatedAt;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->slug = $data['slug'] ?? null;
        $this->contactPerson = $data['contact_person'] ?? null;
        $this->phone = $data['phone'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->address = $data['address'] ?? null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
    }
}
