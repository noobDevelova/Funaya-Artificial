<?php

namespace App\Core\Domains\Supplier\DTOs\Frame;

use App\Core\Domains\Supplier\Entities\SupplierEntities;
use App\Core\Shared\Contracts\BaseDTOInterface;

class SupplierRequest extends SupplierEntities implements BaseDTOInterface
{
    public function __construct(array $data)
    {
        parent::__construct($data);
    }

    public function getAssoc(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'contact_person' => $this->contactPerson,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
        ];
    }
}
