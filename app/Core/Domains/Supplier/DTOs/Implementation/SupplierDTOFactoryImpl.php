<?php

namespace App\Core\Domains\Supplier\DTOs\Implementation;

use App\Core\Domains\Supplier\DTOs\Frame\SupplierRequest;
use App\Core\Domains\Supplier\DTOs\Frame\SupplierResponse;
use App\Core\Domains\Supplier\DTOs\SupplierDTOFactory;

class SupplierDTOFactoryImpl implements SupplierDTOFactory
{
    public function createRequest(array $data): SupplierRequest
    {
        return new SupplierRequest($data);
    }

    public function createResponse(array $data): SupplierResponse
    {
        return new SupplierResponse($data);
    }
}
