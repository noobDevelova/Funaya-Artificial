<?php

namespace App\Core\Domains\Products\Usecases\Implementation;

use App\Core\Domains\Products\DTOs\Frame\ProductRequest;
use App\Core\Domains\Products\Repository\ProductRepository;
use App\Core\Domains\Products\Usecases\CreateProductUseCase;
use App\Core\Shared\Exception\BaseException;
use Config\Database;

class CreateProductUseCaseImpl implements CreateProductUseCase
{
    protected ProductRepository $productRepository;

    protected $db;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
        $this->db = Database::connect();
    }

    public function execute(ProductRequest $data): bool|BaseException
    {
        $this->db->transBegin();

        try {
            $this->productRepository->createProduct($data);

            $this->db->transCommit();

            return true;
        } catch (BaseException $e) {
            $this->db->transRollback();

            throw new BaseException($e->getErrorMessage(), $e->getErrorCode(), 400);
        } catch (\Exception $e) {
            $this->db->transRollback();

            throw new BaseException($e->getMessage(), $e->getCode(), 400);
        }
    }
}
