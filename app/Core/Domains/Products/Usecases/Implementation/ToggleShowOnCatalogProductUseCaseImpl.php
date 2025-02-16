<?php

namespace App\Core\Domains\Products\Usecases\Implementation;

use App\Core\Domains\Products\Repository\ProductRepository;
use App\Core\Domains\Products\Usecases\ToggleShowOnCatalogProductUseCase;
use App\Core\Shared\Exception\BaseException;


class ToggleShowOnCatalogProductUseCaseImpl implements ToggleShowOnCatalogProductUseCase
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(string $slug): bool|BaseException
    {
        try {

            return $this->productRepository->toggleShowOnCatalog($slug);
        } catch (BaseException $e) {
            throw new BaseException(
                $e->getMessage(),
                $e->getCode(),
                400
            );
        } catch (\Exception $e) {
            throw new BaseException(
                $e->getMessage(),
                $e->getCode(),
                500
            );
        }
    }
}
