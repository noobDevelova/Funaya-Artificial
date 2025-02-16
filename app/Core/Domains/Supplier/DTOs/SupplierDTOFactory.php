<?php

namespace App\Core\Domains\Supplier\DTOs;

use App\Core\Domains\Supplier\DTOs\Frame\SupplierRequest;
use App\Core\Domains\Supplier\DTOs\Frame\SupplierResponse;

interface SupplierDTOFactory
{
    public function createRequest(array $data): SupplierRequest;

    public function createResponse(array $data): SupplierResponse;
}
