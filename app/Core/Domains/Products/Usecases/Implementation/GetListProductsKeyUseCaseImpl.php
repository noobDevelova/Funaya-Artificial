<?php

namespace App\Core\Domains\Products\Usecases\Implementation;

use App\Core\Domains\Products\Repository\ProductRepository;
use App\Core\Domains\Products\Usecases\GetListProductsKeyUseCase;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListResponse;

class GetListProductsKeyUseCaseImpl implements GetListProductsKeyUseCase
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(): BaseListResponse | BaseException
    {
        try {
            return $this->productRepository->getListProductKey();
        } catch (\Exception $e) {
            throw new BaseException(
                $e->getMessage(),
                $e->getCode(),
                400
            );
        }
    }
}
