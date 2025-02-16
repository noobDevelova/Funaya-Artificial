<?php

namespace App\Core\Domains\Sales\DTOs\Frame;

use App\Core\Domains\Sales\Entities\SalesEntities;
use App\Core\Shared\Contracts\BaseDTOInterface;

class SalesRequest extends SalesEntities
{

    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    public function getSales(): array
    {
        return [
            'total_amount' => $this->getTotalAmount(),
            'created_by' => $this->createdBy,
        ];
    }

    public function getSalesItems(): array
    {
        return array_map(fn($item) => $item->toArray(), $this->salesItems);
    }
}
