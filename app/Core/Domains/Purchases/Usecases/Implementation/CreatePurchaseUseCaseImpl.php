<?php

namespace App\Core\Domains\Purchases\Usecases\Implementation;

use App\Core\Domains\Purchases\DTOs\Frame\PurchaseRequest;
use App\Core\Domains\Purchases\Repository\PurchasesRepository;
use App\Core\Domains\Purchases\Usecases\CreatePurchaseUseCase;
use App\Core\Shared\Exception\BaseException;
use Config\Database;

class CreatePurchaseUseCaseImpl implements CreatePurchaseUseCase
{
    protected PurchasesRepository $purchasesRepository;

    protected $db;

    public function __construct(PurchasesRepository $purchasesRepository)
    {
        $this->purchasesRepository = $purchasesRepository;
        $this->db = Database::connect();
    }

    public function execute(PurchaseRequest $data): bool|BaseException
    {
        $this->db->transBegin();

        try {
            $this->purchasesRepository->createPurchase($data);

            $this->db->transCommit();

            return true;
        } catch (BaseException $e) {
            $this->db->transRollback();

            throw new BaseException(
                $e->getErrorMessage(),
                $e->getErrorCode(),
                400
            );
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
