<?php

namespace App\Core\Domains\Purchases\Repository;

use App\Core\Domains\Purchases\DTOs\Frame\PurchaseRequest;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\BaseListResponse;

interface PurchasesRepository
{
    public function createPurchase(PurchaseRequest $data): bool|BaseException;

    public function getListPurchases(BaseListParams $params): BaseListResponse;
}
