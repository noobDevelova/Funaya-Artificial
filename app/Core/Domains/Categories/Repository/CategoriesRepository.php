<?php

namespace App\Core\Domains\Categories\Repository;

use App\Core\Domains\Categories\DTOs\Frame\CategoriesRequest;
use App\Core\Domains\Categories\DTOs\Frame\CategoriesResponse;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\BaseListResponse;

interface CategoriesRepository
{
    public function getAllCategories(BaseListParams $params): BaseListResponse;

    public function createCategories(CategoriesRequest $data): bool | BaseException;

    public function getCategoriesBySlug(string $slug): CategoriesResponse | BaseException;

    public function editCategoriesById(CategoriesRequest $data): bool | BaseException;

    public function deleteCategory(int $categoriesId): bool | BaseException;
}
