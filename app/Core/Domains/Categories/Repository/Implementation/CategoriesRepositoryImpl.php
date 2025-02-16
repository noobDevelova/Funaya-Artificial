<?php

namespace App\Core\Domains\Categories\Repository\Implementation;

use App\Core\Domains\Categories\DTOs\CategoriesDTOFactory;
use App\Core\Domains\Categories\DTOs\Frame\CategoriesRequest;
use App\Core\Domains\Categories\DTOs\Frame\CategoriesResponse;
use App\Core\Domains\Categories\Repository\CategoriesRepository;
use App\Core\Domains\Categories\Repository\Model\CategoriesModel;
use App\Core\Shared\Enums\CategoriesError;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\BaseListResponse;


class CategoriesRepositoryImpl implements CategoriesRepository
{
    protected CategoriesModel $categoriesModel;
    protected CategoriesDTOFactory $categoriesDTOFactory;

    public function __construct(
        CategoriesModel $categoriesModel,
        CategoriesDTOFactory $categoriesDTOFactory
    ) {
        $this->categoriesModel = $categoriesModel;
        $this->categoriesDTOFactory = $categoriesDTOFactory;
    }

    public function getAllCategories(BaseListParams $params): BaseListResponse
    {
        $categories = $this->categoriesModel
            ->select('categories.*, COUNT(products.id) as product_count')
            ->join('products', 'products.category_id = categories.id', 'left')
            ->groupBy('categories.id')
            ->paginate($params->limit, 'default', $params->page);

        $countData = $this->categoriesModel->countAllResults();

        $response = array_map(function ($data) {
            return $this->categoriesDTOFactory->createResponse($data);
        }, $categories);

        return new BaseListResponse($response, [
            'current_page' => $params->page,
            'total_count' => $countData,
            'total_pages' => ceil($countData / $params->limit),
            'limit' => $params->limit
        ]);
    }

    public function createCategories(CategoriesRequest $data): bool | BaseException
    {
        if ($this->categoriesModel->where('name', $data->name)->first()) {
            throw new BaseException(
                CategoriesError::CATEGORIES_ALREADY_EXISTS->value,
                'CATEGORIES_ALREADY_EXISTS'
            );
        }

        return $this->categoriesModel->insert($data->getAssoc());
    }

    public function getCategoriesBySlug(string $slug): CategoriesResponse | BaseException
    {
        $categoryData = $this->categoriesModel->where('slug', $slug)->first();

        if (!$categoryData) {
            throw new BaseException(
                CategoriesError::CATEGORIES_NOT_FOUND->value,
                'CATEGORIES_NOT_FOUND',
                400
            );
        }

        return $this->categoriesDTOFactory->createResponse($categoryData);
    }

    public function editCategoriesById(CategoriesRequest $data): bool | BaseException
    {
        $existingCategory = $this->categoriesModel->where('slug', $data->slug)->where('id !=', $data->id)->first();

        if ($existingCategory) {
            throw new BaseException(CategoriesError::CATEGORIES_ALREADY_EXISTS->value, 'CATEGORIES_ALREADY_EXISTS');
        }

        return $this->categoriesModel->update(
            $data->id,
            $data->getAssoc()
        );
    }

    public function deleteCategory(int $categoriesId): bool | BaseException
    {
        $categories = $this->categoriesModel->find($categoriesId);

        if (!$categories) {
            throw new BaseException(
                CategoriesError::CATEGORIES_NOT_FOUND->value,
                'CATEGORIES_NOT_FOUND'
            );
        }

        return $this->categoriesModel->softDelete($categoriesId);
    }
}
