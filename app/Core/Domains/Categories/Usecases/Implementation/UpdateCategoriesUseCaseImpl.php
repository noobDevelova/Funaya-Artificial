<?php

namespace App\Core\Domains\Categories\Usecases\Implementation;

use App\Core\Domains\Categories\DTOs\Frame\CategoriesRequest;
use App\Core\Domains\Categories\Repository\CategoriesRepository;
use App\Core\Domains\Categories\Usecases\UpdateCategoriesUseCase;
use App\Core\Shared\Exception\BaseException;
use Config\Database;


class UpdateCategoriesUseCaseImpl implements UpdateCategoriesUseCase
{
    protected CategoriesRepository $categoriesRepository;
    protected $db;

    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
        $this->db = Database::connect();
    }

    public function execute(CategoriesRequest $data): BaseException | bool
    {
        $this->db->transBegin();

        try {
            $this->categoriesRepository->editCategoriesById($data);

            $this->db->transCommit();

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
