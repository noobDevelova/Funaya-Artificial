<?php

namespace App\Core\Domains\Supplier\Usecases\Implementation;

use App\Core\Domains\Supplier\Repository\SupplierRepository;
use App\Core\Domains\Supplier\Usecases\DeleteSupplierUseCase;
use App\Core\Shared\Exception\BaseException;
use Config\Database;

class DeleteSupplierUseCaseImpl implements DeleteSupplierUseCase
{
    protected SupplierRepository $supplierRepository;
    protected $db;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
        $this->db = Database::connect();
    }

    public function execute(string $slug): bool|BaseException
    {
        $this->db->transBegin();

        try {
            $this->supplierRepository->deleteSupplier($slug);

            $this->db->transCommit();

            return true;
        } catch (BaseException $e) {

            $this->db->transRollback();

            throw new BaseException(
                $e->getErrorMessage(),
                $e->getErrorCode(),
                400,
            );
        } catch (\Exception $e) {

            $this->db->transRollback();

            throw new BaseException(
                $e->getMessage(),
                $e->getCode(),
                400,
            );
        }
    }
}
