<?php

namespace App\Core\Domains\Categories\Usecases\Implementation;

use App\Core\Domains\Categories\DTOs\Frame\CategoriesResponse;
use App\Core\Domains\Categories\Repository\CategoriesRepository;
use App\Core\Domains\Categories\Usecases\GetCategoriesUseCase;
use App\Core\Shared\Exception\BaseException;


class GetCategoriesUseCaseImpl implements GetCategoriesUseCase
{
    protected CategoriesRepository $categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    public function execute(string $slug): CategoriesResponse | BaseException
    {
        try {
            return $this->categoriesRepository->getCategoriesBySlug($slug);
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
