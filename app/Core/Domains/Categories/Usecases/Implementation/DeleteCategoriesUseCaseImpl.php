<?php

namespace App\Core\Domains\Categories\Usecases\Implementation;

use App\Core\Domains\Categories\Repository\CategoriesRepository;
use App\Core\Domains\Categories\Usecases\DeleteCategoriesUseCase;
use App\Core\Shared\Exception\BaseException;
use Config\Database;

class DeleteCategoriesUseCaseImpl implements DeleteCategoriesUseCase
{
    protected CategoriesRepository $categoriesRepository;

    protected $db;

    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;

        $this->db = Database::connect();
    }

    public function execute(int $categoriesId): bool|BaseException
    {
        $this->db->transBegin();

        try {
            $this->categoriesRepository->deleteCategory($categoriesId);

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
