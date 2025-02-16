<?php

namespace App\Core\Domains\Sales\DTOs;

use App\Core\Domains\Sales\DTOs\Frame\SalesRequest;
use App\Core\Domains\Sales\DTOs\Frame\SalesResponse;

interface SalesDTOFactory
{
    public static function createRequest(array $data = []): SalesRequest;

    public static function createResponse(array $data = []): SalesResponse;
}
