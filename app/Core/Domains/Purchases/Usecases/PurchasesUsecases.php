<?php

namespace App\Core\Domains\Purchases\Usecases;

use App\Core\Domains\Purchases\DTOs\Frame\PurchaseRequest;
use App\Core\Domains\Purchases\Repository\PurchasesRepository;
use App\Core\Domains\Purchases\Usecases\Implementation\CreatePurchaseUseCaseImpl;
use App\Core\Domains\Purchases\Usecases\Implementation\GetListPurchasesUseCaseImpl;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\BaseListResponse;

interface CreatePurchaseUseCase
{
    public function execute(PurchaseRequest $data): bool|BaseException;
}

interface GetListPurchasesUseCase
{
    public function execute(BaseListParams $params): BaseListResponse;
}

class PurchasesUsecases
{
    public static function createPurchase(
        PurchasesRepository $purchasesRepository
    ): CreatePurchaseUseCase {
        return new CreatePurchaseUseCaseImpl($purchasesRepository);
    }

    public static function getListPurchases(
        PurchasesRepository $purchasesRepository
    ): GetListPurchasesUseCase {
        return new GetListPurchasesUseCaseImpl($purchasesRepository);
    }
}
