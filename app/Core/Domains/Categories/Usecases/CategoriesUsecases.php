<?php

namespace App\Core\Domains\Categories\Usecases;

use App\Core\Domains\Categories\DTOs\Frame\CategoriesRequest;
use App\Core\Domains\Categories\DTOs\Frame\CategoriesResponse;
use App\Core\Domains\Categories\Repository\CategoriesRepository;
use App\Core\Domains\Categories\Usecases\Implementation\CreateCategoriesUseCaseImpl;
use App\Core\Domains\Categories\Usecases\Implementation\DeleteCategoriesUseCaseImpl;
use App\Core\Domains\Categories\Usecases\Implementation\GetCategoriesUseCaseImpl;
use App\Core\Domains\Categories\Usecases\Implementation\GetListCategoriesUseCaseImpl;
use App\Core\Domains\Categories\Usecases\Implementation\UpdateCategoriesUseCaseImpl;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\BaseListResponse;

interface CreateCategoriesUseCase
{
    public function execute(CategoriesRequest $data): bool | BaseException;
}
interface GetListCategoriesUseCase
{
    public function execute(BaseListParams $params): BaseListResponse | BaseException;
}

interface GetCategoriesUseCase
{
    public function execute(string $slug): CategoriesResponse | BaseException;
}

interface UpdateCategoriesUseCase
{
    public function execute(CategoriesRequest $data): BaseException | bool;
}

interface DeleteCategoriesUseCase
{
    public function execute(int $categoriesId): bool|BaseException;
}



class CategoriesUsecases
{
    public static function create(
        CategoriesRepository $categoriesRepository
    ): CreateCategoriesUseCase {
        return new CreateCategoriesUseCaseImpl($categoriesRepository);
    }

    public static function getList(
        CategoriesRepository $categoriesRepository
    ): GetListCategoriesUseCase {
        return new GetListCategoriesUseCaseImpl($categoriesRepository);
    }

    public static function getSingle(
        CategoriesRepository $categoriesRepository
    ): GetCategoriesUseCase {
        return new GetCategoriesUseCaseImpl($categoriesRepository);
    }

    public static function update(
        CategoriesRepository $categoriesRepository
    ): UpdateCategoriesUseCase {
        return new UpdateCategoriesUseCaseImpl($categoriesRepository);
    }

    public static function delete(
        CategoriesRepository $categoriesRepository
    ): DeleteCategoriesUseCase {
        return new DeleteCategoriesUseCaseImpl($categoriesRepository);
    }
}
