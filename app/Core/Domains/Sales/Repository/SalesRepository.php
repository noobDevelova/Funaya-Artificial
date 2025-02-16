<?php

namespace App\Core\Domains\Sales\Repository;

use App\Core\Domains\Sales\DTOs\Frame\SalesRequest;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\BaseListResponse;

interface SalesRepository
{
    public function createSalesReport(SalesRequest $data): bool|BaseException;

    public function getSalesReports(BaseListParams $data): BaseListResponse;
}
