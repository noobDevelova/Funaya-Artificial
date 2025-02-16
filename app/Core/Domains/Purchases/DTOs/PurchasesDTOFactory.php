<?php

namespace App\Core\Domains\Purchases\DTOs;

use App\Core\Domains\Purchases\DTOs\Frame\PurchaseRequest;
use App\Core\Domains\Purchases\DTOs\Frame\PurchaseResponse;

interface PurchasesDTOFactory
{
    public function createRequest(array $data): PurchaseRequest;

    public function createResponse(array $data): PurchaseResponse;
}
