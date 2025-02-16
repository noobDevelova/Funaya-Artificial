<?php

namespace App\Core\Domains\Supplier\Usecases;

use App\Core\Domains\Supplier\DTOs\Frame\SupplierRequest;
use App\Core\Domains\Supplier\DTOs\Frame\SupplierResponse;
use App\Core\Domains\Supplier\Repository\SupplierRepository;
use App\Core\Domains\Supplier\Usecases\Implementation\CreateSupplierUseCaseImpl;
use App\Core\Domains\Supplier\Usecases\Implementation\DeleteSupplierUseCaseImpl;
use App\Core\Domains\Supplier\Usecases\Implementation\GetListSupplierUseCaseImpl;
use App\Core\Domains\Supplier\Usecases\Implementation\GetSupplierUseCaseImpl;
use App\Core\Domains\Supplier\Usecases\Implementation\UpdateSupplierUseCaseImpl;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\BaseListResponse;

interface CreateSupplierUseCase
{
    public function execute(SupplierRequest $data): bool | BaseException;
}

interface GetListSupplierUseCase
{
    public function execute(BaseListParams $params): BaseListResponse | BaseException;
}

interface GetSupplierUseCase
{
    public function execute(string $slug): SupplierResponse | BaseException;
}

interface UpdateSupplierUseCase
{
    public function execute(SupplierRequest $data): bool | BaseException;
}

interface DeleteSupplierUseCase
{
    public function execute(string $slug): bool|BaseException;
}


class SupplierUsecases
{
    public static function create(
        SupplierRepository $supplierRepository,
    ): CreateSupplierUseCase {
        return new CreateSupplierUseCaseImpl($supplierRepository);
    }

    public static function getList(
        SupplierRepository $supplierRepository,
    ): GetListSupplierUseCase {
        return new GetListSupplierUseCaseImpl($supplierRepository);
    }

    public static function getSingle(
        SupplierRepository $supplierRepository
    ): GetSupplierUseCase {
        return new GetSupplierUseCaseImpl($supplierRepository);
    }

    public static function update(
        SupplierRepository $supplierRepository
    ): UpdateSupplierUseCase {
        return new UpdateSupplierUseCaseImpl($supplierRepository);
    }

    public static function delete(
        SupplierRepository $supplierRepository
    ): DeleteSupplierUseCase {
        return new DeleteSupplierUseCaseImpl($supplierRepository);
    }
}
