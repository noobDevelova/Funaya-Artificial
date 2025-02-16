<?php

namespace App\Core\Domains\Products\DTOs\Implementation;

use App\Core\Domains\Products\DTOs\Frame\ProductRequest;
use App\Core\Domains\Products\DTOs\Frame\ProductResponse;
use App\Core\Domains\Products\DTOs\ProductDTOFactory;

class ProductDTOFactoryImpl implements ProductDTOFactory
{
    public static function createRequest(array $data): ProductRequest
    {
        return new ProductRequest($data);
    }

    public static function createResponse(array $data): ProductResponse
    {
        return new ProductResponse($data);
    }
}
