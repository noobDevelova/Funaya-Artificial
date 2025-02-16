<?php

namespace App\Core\Domains\Purchases\Usecases\Implementation;

use App\Core\Domains\Purchases\Repository\PurchasesRepository;
use App\Core\Domains\Purchases\Usecases\GetListPurchasesUseCase;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\BaseListResponse;

class GetListPurchasesUseCaseImpl implements GetListPurchasesUseCase
{
    protected PurchasesRepository $purchasesRepository;

    public function __construct(PurchasesRepository $purchasesRepository)
    {
        $this->purchasesRepository = $purchasesRepository;
    }

    public function execute(BaseListParams $params): BaseListResponse
    {
        try {
            return $this->purchasesRepository->getListPurchases($params);
        } catch (\Exception $e) {
            throw new BaseException(
                $e->getMessage(),
                $e->getCode(),
                400
            );
        }
    }
}
