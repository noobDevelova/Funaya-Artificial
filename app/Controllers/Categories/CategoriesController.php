<?php

namespace App\Controllers\Categories;

use App\Controllers\BaseController;
use App\Core\Adapters\EnvAdapter;
use App\Core\Domains\Categories\DTOs\CategoriesDTOFactory;
use App\Core\Domains\Categories\Usecases\CreateCategoriesUseCase;
use App\Core\Domains\Categories\Usecases\DeleteCategoriesUseCase;
use App\Core\Domains\Categories\Usecases\GetCategoriesUseCase;
use App\Core\Domains\Categories\Usecases\GetListCategoriesUseCase;
use App\Core\Domains\Categories\Usecases\UpdateCategoriesUseCase;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\Response;
use App\Helpers\CreateSlug;
use App\Schemas\CreateCategoriesSchema;
use App\Schemas\EditCategoriesSchema;
use Config\Services;

class CategoriesController extends BaseController
{
    protected $ENV_ADAPTER;
    protected $validation;

    protected CategoriesDTOFactory $categoriesDTOFactory;

    protected GetListCategoriesUseCase $getListCategoriesUseCase;
    protected CreateCategoriesUseCase $createCategoriesUseCase;
    protected GetCategoriesUseCase $getCategoriesUseCase;
    protected UpdateCategoriesUseCase $updateCategoriesUseCase;
    protected DeleteCategoriesUseCase $deleteCategoriesUseCase;

    public function __construct()
    {
        $this->ENV_ADAPTER = new EnvAdapter();
        $this->validation = Services::validation();

        $this->categoriesDTOFactory = Services::categoriesDTOfactory();

        $this->getListCategoriesUseCase = Services::getListCategoriesUseCase();
        $this->createCategoriesUseCase = Services::createCategoriesUseCase();
        $this->getCategoriesUseCase = Services::getCategoriesUseCase();
        $this->updateCategoriesUseCase = Services::updateCategoriesUseCase();
        $this->deleteCategoriesUseCase = Services::deleteCategoriesUseCase();
    }

    private function getIndexData()
    {
        $params = new BaseListParams([
            'page' => (int) $this->request->getVar('page') ?: 1,
            'limit' => 4
        ]);

        try {
            $response = $this->getListCategoriesUseCase->execute($params);

            return [
                'categories' => $response->getItems(),
                'pagination' => $response->getPagination(),
                'error_message' => ''
            ];
        } catch (BaseException $e) {
            return [
                'categories' => [],
                'pagination' => [],
                'error_message' => $e->getMessage()
            ];
        }
    }


    public function index()
    {
        $metadata = [
            'title' => 'Kategori ' . $this->ENV_ADAPTER->getAppName(),
            'current' => 'Categories'
        ];

        $indexData = $this->getIndexData();

        return view('categories/index', [
            'categories' => $indexData['categories'],
            'pagination' => $indexData['pagination'],
            'error_message' => $indexData['error_message']
        ] + $metadata);
    }

    public function store()
    {
        $requestData = $this->request->getJSON(true);

        $this->validation->setRules(CreateCategoriesSchema::getRules());

        if (!$this->validation->run($requestData)) {
            return Response::error(
                "Invalid Input Data",
                'INVALID_INPUT',
                400,
                $this->validation->getErrors()
            );
        }

        try {
            $dto = $this->categoriesDTOFactory->createRequest([
                'name' => $requestData['name'],
                'slug' => CreateSlug::create($requestData['name']),
                'description' => $requestData['name']
            ]);

            $this->createCategoriesUseCase->execute($dto);

            return Response::success(
                'success',
                [],
                200
            );
        } catch (BaseException $e) {
            return Response::error(
                $e->getErrorMessage(),
                $e->getErrorCode(),
                $e->getCode()
            );
        }
    }

    public function getCategories(string $slug)
    {
        try {
            $categories = $this->getCategoriesUseCase->execute($slug);

            return Response::success(
                'Success Get Categories!',
                $categories->getAssoc(),
                200
            );
        } catch (BaseException $e) {
            return Response::error(
                $e->getErrorMessage(),
                $e->getErrorCode(),
                $e->getCode()
            );
        }
    }

    public function update()
    {
        $requestData = $this->request->getJSON(true);

        $this->validation->setRules(EditCategoriesSchema::getRules());

        if (!$this->validation->run($requestData)) {
            return Response::error(
                "Invalid Input Data",
                'INVALID_INPUT',
                400,
                $this->validation->getErrors()
            );
        }

        try {

            $dto = $this->categoriesDTOFactory->createRequest([
                'id' => $requestData['id'],
                'name' => $requestData['name'],
                'slug' => CreateSlug::create($requestData['name']),
                'description' => $requestData['description']
            ]);

            $this->updateCategoriesUseCase->execute($dto);

            return Response::success(
                'Success Update Categories!',
                [],
                200
            );
        } catch (BaseException $e) {
            return Response::error(
                $e->getErrorMessage(),
                $e->getErrorCode(),
                $e->getCode()
            );
        }
    }

    public function delete()
    {
        $categoriesId = $this->request->getJSON(true);

        if (!$categoriesId) {
            return Response::error(
                'Category ID is not Included!',
                'CATEGORY_ID_UNDEFINED',
                400,
                []
            );
        }

        try {
            $this->deleteCategoriesUseCase->execute($categoriesId['id']);

            return Response::success(
                'Success Delete Categories!',
                [],
                200
            );
        } catch (BaseException $e) {
            return Response::error(
                $e->getErrorMessage(),
                $e->getErrorCode(),
                400,
                []
            );
        }
    }
}
