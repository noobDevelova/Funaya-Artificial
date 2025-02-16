<?php

namespace App\Core\Domains\Categories\Usecases\Implementation;

use App\Core\Domains\Categories\DTOs\CategoriesCreateRequest;
use App\Core\Domains\Categories\DTOs\Frame\CategoriesRequest;
use App\Core\Domains\Categories\Repository\CategoriesRepository;
use App\Core\Domains\Categories\Usecases\CreateCategoriesUseCase;
use App\Core\Shared\Exception\BaseException;
use Config\Database;

class CreateCategoriesUseCaseImpl implements CreateCategoriesUseCase
{
    protected $db;
    protected CategoriesRepository $categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->db = Database::connect();
        $this->categoriesRepository = $categoriesRepository;
    }

    public function execute(CategoriesRequest $data): bool | BaseException
    {
        $this->db->transBegin();

        try {
            $this->categoriesRepository->createCategories($data);

            $this->db->transCommit();

            return true;
        } catch (\Exception $e) {
            $this->db->transRollback();

            return new BaseException(
                $e->getMessage(),
                $e->getCode(),
                400
            );
        }
    }
}
