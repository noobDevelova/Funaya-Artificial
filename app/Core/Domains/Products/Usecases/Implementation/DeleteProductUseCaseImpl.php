<?php

namespace App\Core\Domains\Products\Usecases\Implementation;

use App\Core\Domains\Products\Repository\ProductRepository;
use App\Core\Domains\Products\Usecases\DeleteProductUseCase;
use App\Core\Shared\Exception\BaseException;

class DeleteProductUseCaseImpl implements DeleteProductUseCase
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(string $slug): bool|BaseException
    {
        try {
            return $this->productRepository->deleteProduct($slug);
        } catch (BaseException $e) {
            throw new BaseException($e->getErrorMessage(), $e->getErrorCode(), 400);
        } catch (\Exception $e) {
            throw new BaseException($e->getMessage(), $e->getCode(), 500);
        }
    }
}
