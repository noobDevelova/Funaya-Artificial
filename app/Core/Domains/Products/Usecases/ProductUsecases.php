<?php

namespace App\Core\Domains\Products\Usecases;

use App\Core\Domains\Products\DTOs\Frame\ProductRequest;
use App\Core\Domains\Products\DTOs\Frame\ProductResponse;
use App\Core\Domains\Products\Repository\ProductRepository;
use App\Core\Domains\Products\Usecases\Implementation\CreateProductUseCaseImpl;
use App\Core\Domains\Products\Usecases\Implementation\GetListProductsKeyUseCaseImpl;
use App\Core\Domains\Products\Usecases\Implementation\GetListProductsUseCaseImpl;
use App\Core\Domains\Products\Usecases\Implementation\GetProductUseCaseImpl;
use App\Core\Domains\Products\Usecases\Implementation\UpdateProductUseCaseImpl;
use App\Core\Domains\Products\Usecases\Implementation\ToggleShowOnCatalogProductUseCaseImpl;
use App\Core\Domains\Products\Usecases\Implementation\DeleteProductUseCaseImpl;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\BaseListResponse;


interface CreateProductUseCase
{
    public function execute(ProductRequest $data): bool|BaseException;
}

interface GetListProductsUseCase
{
    public function execute(BaseListParams $params): BaseListResponse|BaseException;
}

interface GetProductUseCase
{
    public function execute(string $slug): BaseException|ProductResponse;
}

interface UpdateProductUseCase
{
    public function execute(ProductRequest $data): bool|BaseException;
}

interface GetListProductsKeyUseCase
{
    public function execute(): BaseListResponse | BaseException;
}

interface DeleteProductUseCase
{
    public function execute(string $slug): bool|BaseException;
}

interface ToggleShowOnCatalogProductUseCase
{
    public function execute(string $slug): bool|BaseException;
}


class ProductUsecases
{
    public static function createProduct(
        ProductRepository $productRepository
    ): CreateProductUseCase {
        return new CreateProductUseCaseImpl($productRepository);
    }

    public static function getList(
        ProductRepository $productRepository
    ): GetListProductsUseCase {
        return new GetListProductsUseCaseImpl($productRepository);
    }

    public static function getProduct(
        ProductRepository $productRepository
    ): GetProductUseCase {
        return new GetProductUseCaseImpl($productRepository);
    }

    public static function updateProduct(
        ProductRepository $productRepository
    ): UpdateProductUseCase {
        return new UpdateProductUseCaseImpl($productRepository);
    }

    public static function getKey(
        ProductRepository $productRepository
    ): GetListProductsKeyUseCase {
        return new GetListProductsKeyUseCaseImpl($productRepository);
    }

    public static function toggleShowOnCatalog(
        ProductRepository $productRepository
    ): ToggleShowOnCatalogProductUseCase {
        return new ToggleShowOnCatalogProductUseCaseImpl($productRepository);
    }

    public static function deleteProduct(
        ProductRepository $productRepository
    ): DeleteProductUseCase {
        return new DeleteProductUseCaseImpl($productRepository);
    }
}
