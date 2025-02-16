<?php

namespace App\Core\Domains\Products\Usecases\Implementation;

use App\Core\Domains\Products\DTOs\Frame\ProductResponse;
use App\Core\Domains\Products\Repository\ProductRepository;
use App\Core\Domains\Products\Usecases\GetProductUseCase;
use App\Core\Shared\Exception\BaseException;

class GetProductUseCaseImpl implements GetProductUseCase
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(string $slug): BaseException|ProductResponse
    {
        try {
            return $this->productRepository->getProduct($slug);
        } catch (BaseException $e) {
            throw new BaseException(
                $e->getErrorMessage(),
                $e->getErrorCode(),
                400
            );
        } catch (\Exception $e) {
            throw new BaseException(
                $e->getMessage(),
                $e->getCode(),
                400
            );
        }
    }
}
