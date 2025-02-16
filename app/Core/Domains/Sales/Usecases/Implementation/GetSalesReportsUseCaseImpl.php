<?php

namespace App\Core\Domains\Sales\Usecases\Implementation;

use App\Core\Domains\Sales\Repository\SalesRepository;
use App\Core\Domains\Sales\Usecases\GetSalesReportsUseCase;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\BaseListResponse;

class GetSalesReportsUseCaseImpl implements GetSalesReportsUseCase
{
    protected SalesRepository $salesRepository;

    public function __construct(SalesRepository $salesRepository)
    {
        $this->salesRepository = $salesRepository;
    }

    public function execute(BaseListParams $params): BaseListResponse | BaseException
    {
        try {
            return $this->salesRepository->getSalesReports($params);
        } catch (\Exception $e) {
            throw new BaseException(
                $e->getMessage(),
                $e->getCode(),
                400
            );
        }
    }
}
