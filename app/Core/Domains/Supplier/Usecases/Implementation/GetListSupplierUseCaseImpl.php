<?php

namespace App\Core\Domains\Supplier\Usecases\Implementation;

use App\Core\Domains\Supplier\Repository\SupplierRepository;
use App\Core\Domains\Supplier\Usecases\GetListSupplierUseCase;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\BaseListResponse;


class GetListSupplierUseCaseImpl implements GetListSupplierUseCase
{
    protected SupplierRepository $supplierRepository;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function execute(BaseListParams $params): BaseListResponse | BaseException
    {
        try {
            return $this->supplierRepository->getAllSuppliers($params);
        } catch (\Exception $e) {
            return new BaseException(
                $e->getMessage(),
                $e->getCode(),
                400
            );
        }
    }
}
