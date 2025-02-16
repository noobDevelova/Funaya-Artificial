<?php

namespace App\Core\Domains\Sales\DTOs\Implementation;

use App\Core\Domains\Sales\DTOs\Frame\SalesRequest;
use App\Core\Domains\Sales\DTOs\Frame\SalesResponse;
use App\Core\Domains\Sales\DTOs\SalesDTOFactory;

class SalesDTOFactoryImpl implements SalesDTOFactory
{
    public static function createRequest(array $data = []): SalesRequest
    {
        return new SalesRequest($data);
    }

    public static function createResponse(array $data = []): SalesResponse
    {
        return new SalesResponse($data);
    }
}
