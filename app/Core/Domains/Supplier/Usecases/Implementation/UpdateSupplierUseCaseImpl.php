<?php

namespace App\Core\Domains\Supplier\Usecases\Implementation;

use App\Core\Domains\Supplier\DTOs\Frame\SupplierRequest;
use App\Core\Domains\Supplier\Repository\SupplierRepository;
use App\Core\Domains\Supplier\Usecases\UpdateSupplierUseCase;
use App\Core\Shared\Exception\BaseException;
use Config\Database;

class UpdateSupplierUseCaseImpl implements UpdateSupplierUseCase
{
    protected SupplierRepository $supplierRepository;

    protected $db;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
        $this->db = Database::connect();
    }

    public function execute(SupplierRequest $data): bool|BaseException
    {
        $this->db->transBegin();

        try {
            $this->supplierRepository->updateSupplierById($data);

            $this->db->transCommit();

            log_message('debug', 'success update');

            return true;
        } catch (\Exception $e) {
            $this->db->transRollback();

            throw new BaseException(
                $e->getMessage(),
                $e->getCode(),
                400
            );
        }
    }
}
