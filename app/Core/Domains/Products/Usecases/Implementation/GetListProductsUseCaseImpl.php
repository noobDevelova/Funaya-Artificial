<?php

namespace App\Core\Domains\Products\Usecases\Implementation;

use App\Core\Domains\Products\Repository\ProductRepository;
use App\Core\Domains\Products\Usecases\GetListProductsUseCase;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\BaseListResponse;
use App\Core\Shared\Exception\BaseException;

class GetListProductsUseCaseImpl implements GetListProductsUseCase
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(BaseListParams $params): BaseListResponse|BaseException
    {
        try {
            return $this->productRepository->getListProducts($params);
        } catch (BaseException $e) {
            throw new BaseException($e->getErrorMessage(), $e->getErrorCode(), 400);
        } catch (\Exception $e) {
            throw new BaseException($e->getMessage(), $e->getCode(), 400);
        }
    }
}
