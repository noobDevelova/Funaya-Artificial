<?php

namespace App\Core\Domains\Supplier\Usecases\Implementation;

use App\Core\Domains\Supplier\DTOs\Frame\SupplierRequest;
use App\Core\Domains\Supplier\Repository\SupplierRepository;
use App\Core\Domains\Supplier\Usecases\CreateSupplierUseCase;
use App\Core\Shared\Exception\BaseException;
use Config\Database;

class CreateSupplierUseCaseImpl implements CreateSupplierUseCase
{
    protected SupplierRepository $supplierRepository;
    protected $db;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;

        $this->db = Database::connect();
    }

    public function execute(SupplierRequest $data): bool | BaseException
    {
        $this->db->transBegin();

        try {
            $this->supplierRepository->createSupplier($data);

            $this->db->transCommit();

            return true;
        } catch (BaseException $e) {
            $this->db->transRollback();

            return new BaseException($e->getErrorMessage(), $e->getErrorCode(), 400);
        } catch (\Exception $e) {
            $this->db->transRollback();

            return new BaseException($e->getMessage(), $e->getCode(), 400);
        }
    }
}
