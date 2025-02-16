<?php

namespace App\Core\Domains\Supplier\DTOs\Frame;

use App\Core\Domains\Supplier\Entities\SupplierEntities;
use App\Core\Shared\Contracts\BaseDTOInterface;

class SupplierResponse extends SupplierEntities implements BaseDTOInterface
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
            'contactPerson' => $this->contactPerson,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }
}
