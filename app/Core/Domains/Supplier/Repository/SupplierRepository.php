<?php

namespace App\Core\Domains\Supplier\Repository;

use App\Core\Domains\Supplier\DTOs\Frame\SupplierRequest;
use App\Core\Domains\Supplier\DTOs\Frame\SupplierResponse;
use App\Core\Domains\Supplier\DTOs\SupplierCreateRequest;
use App\Core\Domains\Supplier\DTOs\SupplierCreateResponse;
use App\Core\Domains\Supplier\DTOs\SupplierUpdateRequest;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\BaseListResponse;

interface SupplierRepository
{
    public function getAllSuppliers(BaseListParams $params): BaseListResponse;

    public function createSupplier(SupplierRequest $data): bool | BaseException;

    public function getSupplierBySlug(string $slug): SupplierResponse | BaseException;

    public function updateSupplierById(SupplierRequest $data): bool | BaseException;

    public function deleteSupplier(string $slug): bool|BaseException;
}
