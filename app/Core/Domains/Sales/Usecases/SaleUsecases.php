<?php

namespace App\Core\Domains\Sales\Usecases;

use App\Core\Domains\Sales\DTOs\Frame\SalesRequest;
use App\Core\Domains\Sales\Repository\SalesRepository;
use App\Core\Domains\Sales\Usecases\Implementation\CreateSalesReportUseCaseImpl;
use App\Core\Domains\Sales\Usecases\Implementation\GetSalesReportsUseCaseImpl;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\BaseListResponse;

interface CreateSalesReportUseCase
{
    public function execute(SalesRequest $data): bool|BaseException;
}

interface GetSalesReportsUseCase
{
    public function execute(BaseListParams $params): BaseListResponse | BaseException;
}

class SaleUsecases
{
    public static function createReport(
        SalesRepository $salesRepository
    ): CreateSalesReportUseCase {
        return new CreateSalesReportUseCaseImpl($salesRepository);
    }

    public static function getReports(
        SalesRepository $salesRepository
    ): GetSalesReportsUseCase {
        return new GetSalesReportsUseCaseImpl($salesRepository);
    }
}
