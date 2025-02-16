<?php

namespace App\Core\Domains\Sales\DTOs\Frame;

use App\Core\Domains\Sales\Entities\SalesEntities;

class SalesResponse extends SalesEntities
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }
}
