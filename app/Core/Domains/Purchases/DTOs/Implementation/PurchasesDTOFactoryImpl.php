<?php

namespace App\Core\Domains\Purchases\DTOs\Implementation;

use App\Core\Domains\Purchases\DTOs\Frame\PurchaseRequest;
use App\Core\Domains\Purchases\DTOs\Frame\PurchaseResponse;
use App\Core\Domains\Purchases\DTOs\PurchasesDTOFactory;

class PurchasesDTOFactoryImpl implements PurchasesDTOFactory
{
    public function createRequest(array $data): PurchaseRequest
    {
        return new PurchaseRequest($data);
    }

    public function createResponse(array $data): PurchaseResponse
    {
        return new PurchaseResponse($data);
    }
}
