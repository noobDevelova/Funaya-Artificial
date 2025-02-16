<?php

namespace App\Core\Domains\Products\Repository;

use App\Core\Domains\Products\DTOs\Frame\ProductRequest;
use App\Core\Domains\Products\DTOs\Frame\ProductResponse;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\BaseListResponse;

interface ProductRepository
{
    public function createProduct(ProductRequest $data): bool|BaseException;

    public function getListProducts(BaseListParams $params): BaseListResponse;

    public function getProduct(string $slug): ProductResponse|BaseException;

    public function updateProduct(ProductRequest $data): bool|BaseException;

    public function getListProductKey(): BaseListResponse;

    public function deleteProduct(string $slug): bool|BaseException;

    public function toggleShowOnCatalog(string $slug): bool|BaseException;
}
