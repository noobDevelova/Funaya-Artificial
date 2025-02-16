<?php

namespace App\Core\Domains\Supplier\Usecases\Implementation;

use App\Core\Domains\Supplier\DTOs\Frame\SupplierResponse;
use App\Core\Domains\Supplier\DTOs\SupplierCreateResponse;
use App\Core\Domains\Supplier\Repository\SupplierRepository;
use App\Core\Domains\Supplier\Usecases\GetSupplierUseCase;
use App\Core\Shared\Exception\BaseException;

class GetSupplierUseCaseImpl implements GetSupplierUseCase
{
    protected SupplierRepository $supplierRepository;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function execute(string $slug): BaseException|SupplierResponse
    {
        try {
            return $this->supplierRepository->getSupplierBySlug($slug);
        } catch (BaseException $e) {
            throw new BaseException(
                $e->getErrorMessage(),
                $e->getErrorCode(),
                400,
            );
        } catch (\Exception $e) {
            throw new BaseException(
                $e->getMessage(),
                $e->getCode(),
                500,
            );
        }
    }
}
