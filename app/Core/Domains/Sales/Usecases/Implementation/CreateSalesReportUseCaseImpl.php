<?php

namespace App\Core\Domains\Sales\Usecases\Implementation;

use App\Core\Domains\Sales\DTOs\Frame\SalesRequest;
use App\Core\Domains\Sales\Repository\SalesRepository;
use App\Core\Domains\Sales\Usecases\CreateSalesReportUseCase;
use App\Core\Shared\Exception\BaseException;
use Config\Database;

class CreateSalesReportUseCaseImpl implements CreateSalesReportUseCase
{
    protected SalesRepository $salesRepository;
    protected $db;

    public function __construct(SalesRepository $salesRepository)
    {
        $this->salesRepository = $salesRepository;
        $this->db = Database::connect();
    }

    public function execute(SalesRequest $data): bool|BaseException
    {
        $this->db->transBegin();

        try {
            $this->salesRepository->createSalesReport($data);

            return $this->db->transCommit();
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
