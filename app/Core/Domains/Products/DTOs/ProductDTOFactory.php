<?php

namespace App\Core\Domains\Products\DTOs;

use App\Core\Domains\Products\DTOs\Frame\ProductRequest;
use App\Core\Domains\Products\DTOs\Frame\ProductResponse;

interface ProductDTOFactory
{
    public static function createRequest(array $data): ProductRequest;

    public static function createResponse(array $data): ProductResponse;
}
