<?php

namespace App\Controllers\Products;

use App\Controllers\BaseController;
use App\Core\Adapters\EnvAdapter;
use App\Core\Domains\Categories\Usecases\GetListCategoriesUseCase;
use App\Core\Domains\Products\DTOs\ProductDTOFactory;
use App\Core\Domains\Products\Usecases\CreateProductUseCase;
use App\Core\Domains\Products\Usecases\GetListProductsUseCase;
use App\Core\Domains\Products\Usecases\GetProductUseCase;
use App\Core\Domains\Products\Usecases\UpdateProductUseCase;
use App\Core\Domains\Products\Usecases\ToggleShowOnCatalogProductUseCase;
use App\Core\Domains\Products\Usecases\DeleteProductUseCase;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\Response;
use App\Helpers\CreateSlug;
use App\Infrastructure\FileServices;
use App\Schemas\CreateProductSchema;
use Config\Services;

class ProductsController extends BaseController
{
    protected $ENV_ADAPTER;
    protected $validation;

    protected FileServices $fileServices;
    protected ProductDTOFactory $productDTOFactory;
    protected GetListCategoriesUseCase $getListCategoriesUseCase;
    protected CreateProductUseCase $createProductUseCase;
    protected GetListProductsUseCase $getListProductsUseCase;
    protected GetProductUseCase $getProductUseCase;
    protected UpdateProductUseCase $updateProductUseCase;
    protected ToggleShowOnCatalogProductUseCase $toggleShowOnCatalogProductUseCase;
    protected DeleteProductUseCase $deleteProductUseCase;

    public function __construct()
    {
        $this->ENV_ADAPTER = new EnvAdapter();
        $this->validation = Services::validation();
        $this->fileServices = new FileServices();

        $this->productDTOFactory = Services::productDTOFactory();

        $this->getListCategoriesUseCase = Services::getListCategoriesUseCase();
        $this->createProductUseCase = Services::createProductUseCase();
        $this->getListProductsUseCase = Services::getListProductUseCase();
        $this->getProductUseCase = Services::getProductUseCase();
        $this->updateProductUseCase = Services::updateProductUseCase();
        $this->toggleShowOnCatalogProductUseCase = Services::toggleShowOnCatalogProductUseCase();
        $this->deleteProductUseCase = Services::deleteProductUseCase();
    }

    private function getIndexData()
    {
        $params = new BaseListParams([
            'page' => (int) $this->request->getVar('page') ?: 1,
            'limit' => 10
        ]);

        try {
            $response = $this->getListProductsUseCase->execute($params);

            return [
                'products' => $response->getItems(),
                'pagination' => $response->getPagination(),
                'error_message' => ''
            ];
        } catch (BaseException $e) {
            return [
                'products' => [],
                'pagination' => [],
                'error_message' => $e->getMessage()
            ];
        }
    }

    public function index()
    {
        $metadata = [
            'title' => 'Admin - Produk | ' . $this->ENV_ADAPTER->getAppName(),
            'current' => 'Products'
        ];

        $indexData = $this->getIndexData();

        return view('products/list/index', [
            'products' => $indexData['products'],
            'pagination' => $indexData['pagination'],
            'error_message' => $indexData['error_message']
        ] + $metadata);
    }

    public function create()
    {
        $metadata = [
            'title' => 'Admin - Buat Produk | ' . $this->ENV_ADAPTER->getAppName(),
            'current' => 'Products'
        ];

        $categories = $this->getListCategoriesUseCase->execute(new BaseListParams([
            'page' => 1,
            'limit' => 1000
        ]));

        return view('products/create/index', [
            'categories' => $categories->getItems(),
            'pagination' => $categories->getPagination(),
            'error_message' => ''
        ] + $metadata);
    }

    public function store()
    {
        $productData = json_decode($this->request->getVar('product_data'), true);

        $productImage = $this->request->getFile('cover_image');

        $this->validation->setRules(CreateProductSchema::getRules());

        if (!$this->validation->run($productData)) {
            return Response::error(
                "Invalid Input Data",
                'INVALID_INPUT',
                400,
                $this->validation->getErrors()
            );
        }

        if (!$productImage) {
            return Response::error(
                "Invalid Input Data",
                'PRODUCT_IMAGE_REQUIRED',
                400,
                []
            );
        }

        $productData['slug'] = CreateSlug::create($productData['name']);
        $productData['created_by'] = session()->get('id');
        $productData['cover_image_file'] = $productImage;

        try {
            $dto = $this->productDTOFactory->createRequest($productData);

            $this->createProductUseCase->execute($dto);

            return Response::success(
                'Success Create Product!',
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

    public function edit(string $slug)
    {
        $metadata = [
            'title' => 'Edit Produk | ' . $this->ENV_ADAPTER->getAppName(),
            'current' => 'Products'
        ];

        $categories = $this->getListCategoriesUseCase->execute(new BaseListParams([
            'page' => 1,
            'limit' => 1000
        ]));

        $product = $this->getProductUseCase->execute($slug);

        return view('products/edit/index', [
            'product' => $product->getDetailData(true),
            'categories' => $categories->getItems(),
            'pagination' => $categories->getPagination(),
            'error_message' => ''
        ] + $metadata);
    }

    public function update()
    {
        $productData = json_decode($this->request->getVar('product_data'), true);

        $productImage = $this->request->getFile('cover_image');

        $this->validation->setRules(CreateProductSchema::getRules());

        if (!$this->validation->run($productData)) {
            return Response::error(
                "Invalid Input Data",
                'INVALID_INPUT',
                400,
                $this->validation->getErrors()
            );
        }

        $productData['slug'] = CreateSlug::create($productData['name']);
        $productData['updated_by'] = session()->get('id');
        $productData['cover_image_file'] = $productImage ?? null;

        try {
            $dto = $this->productDTOFactory->createRequest($productData);

            $this->updateProductUseCase->execute($dto);

            return Response::success(
                'Success Update Product!',
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

    public function getProduct(string $slug)
    {
        $product = $this->getProductUseCase->execute($slug);

        return Response::success(
            'Success Get Product!',
            $product->getAssoc(),
            200
        );
    }

    public function toggleShowOnCatalog()
    {
        $requestData = $this->request->getJSON(true);

        log_message('debug', json_encode($requestData));

        $slug = $requestData['slug'];

        try {

            log_message('debug', json_encode($slug));

            $this->toggleShowOnCatalogProductUseCase->execute($slug);

            return Response::success('Success Toggle Show On Catalog!', [], 200);
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
        $requestData = $this->request->getJSON(true);

        $slug = $requestData['slug'];

        try {
            $this->deleteProductUseCase->execute($slug);

            return Response::success('Success Delete Product!', [], 200);
        } catch (BaseException $e) {
            return Response::error(
                $e->getErrorMessage(),
                $e->getErrorCode(),
                $e->getCode()
            );
        }
    }
}
