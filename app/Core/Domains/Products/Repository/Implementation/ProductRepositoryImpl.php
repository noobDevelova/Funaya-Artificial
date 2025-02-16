<?php

namespace App\Core\Domains\Products\Repository\Implementation;

use App\Core\Domains\Products\DTOs\Frame\ProductRequest;
use App\Core\Domains\Products\DTOs\Frame\ProductResponse;
use App\Core\Domains\Products\DTOs\ProductDTOFactory;
use App\Core\Domains\Products\Repository\Model\ProductDetailModel;
use App\Core\Domains\Products\Repository\Model\ProductModel;
use App\Core\Domains\Products\Repository\ProductRepository;
use App\Core\Shared\Enums\ProductError;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\BaseListResponse;
use App\Infrastructure\FileServices;

class ProductRepositoryImpl implements ProductRepository
{
    protected ProductModel $productModel;
    protected ProductDetailModel $productDetailModel;

    protected ProductDTOFactory $productDTOFactory;
    protected FileServices $fileServices;

    public function __construct(
        ProductModel $productModel,
        ProductDetailModel $productDetailModel,
        ProductDTOFactory $productDTOFactory,
        FileServices $fileServices
    ) {
        $this->productModel = $productModel;
        $this->productDetailModel = $productDetailModel;
        $this->productDTOFactory = $productDTOFactory;
        $this->fileServices = $fileServices;
    }

    public function createProduct(ProductRequest $data): bool|BaseException
    {
        $existingProduct = $this->productModel->where('slug', $data->slug)->first();

        if ($existingProduct) {
            throw new BaseException(ProductError::PRODUCT_EXISTS->value, 'PRODUCT_EXISTS', 400);
        }

        $productId = $this->productModel->insert($data->getAssoc());

        if (!$productId) {
            throw new BaseException(ProductError::PRODUCT_INSERT_FAILED->value, 'PRODUCT_INSERT_FAILED', 400);
        }

        $productDetail = $data->getDetailAssoc();
        $productDetail['product_id'] = $productId;

        $this->productDetailModel->insert($productDetail);

        $imageName = $this->fileServices->saveImage($data->getImageFile(), 'products', $data->slug . '.png');

        return $this->productModel->where('id', $productId)->set('cover_image', $imageName)->update();
    }

    public function getListProducts(BaseListParams $params): BaseListResponse
    {
        $builder = $this->productModel
            ->select('products.*, c.id AS category_id, c.name AS category_name')
            ->join('categories c', 'c.id = products.category_id', 'left')
            ->where('products.deleted_at', null);

        $products = $builder->paginate($params->limit, 'default', $params->page);

        $countData = $this->productModel->countAllResults();

        $response = array_map(function ($data) {
            return $this->productDTOFactory->createResponse($data)->getObj();
        }, $products);

        return new BaseListResponse($response, [
            'current_page' => $params->page,
            'total_count' => $countData,
            'total_pages' => ceil($countData / $params->limit),
            'limit' => $params->limit
        ]);
    }

    public function getProduct(string $slug): BaseException|ProductResponse
    {
        if (!$slug) {
            throw new BaseException(ProductError::PRODUCT_READ_FAILED->value, 'PRODUCT_READ_FAILED', 400);
        }

        $product = $this->productModel
            ->join('product_details', 'product_details.product_id = products.id')
            ->join('categories', 'categories.id = products.category_id')
            ->select('products.*,
                              product_details.color,
                              product_details.size,
                              product_details.material,
                              product_details.description,
                              product_details.additional_info,
                              categories.id as category_id, 
                              categories.name as category_name,')
            ->where('products.slug', $slug)
            ->first();


        if (!$product) {
            throw new BaseException(ProductError::PRODUCT_NOT_FOUND->value, 'PRODUCT_NOT_FOUND', 400);
        }

        return $this->productDTOFactory->createResponse($product);
    }

    public function updateProduct(ProductRequest $data): BaseException|bool
    {
        $validateExisting = $this->productModel->where('slug', $data->slug)->where('id !=', $data->id)->first();

        if ($validateExisting) {
            throw new BaseException(ProductError::PRODUCT_EXISTS->value, 'PRODUCT_EXISTS', 400);
        }

        $product = $this->productModel->find($data->id);

        if (!$product) {
            throw new BaseException(ProductError::PRODUCT_NOT_FOUND->value, 'PRODUCT_NOT_FOUND', 400);
        }

        $this->productModel->update($data->id, $data->getAssoc());
        $this->productDetailModel->where('product_id', $data->id)->update(null, $data->getDetailAssoc());

        if ($data->coverImageFile) {
            if (!$this->fileServices->isSameFile($data->coverImageFile, $product['cover_image'], 'products')) {
                if (!empty($product['cover_image'])) {
                    $this->fileServices->deleteFile($product['cover_image'], 'products');
                }

                $newFileName = $data->slug . '.' . $data->coverImageFile->getExtension();
                $newFileName = $this->fileServices->saveImage($data->coverImageFile, 'products', $newFileName);

                $this->productModel->update($data->id, ['cover_image' => $newFileName]);
            }
        } else {
            if ($data->slug !== $product['slug'] && !empty($product['cover_image'])) {
                $oldFileName = $product['cover_image'];
                $extension = pathinfo($oldFileName, PATHINFO_EXTENSION);
                $newFileName = $data->slug . '.' . $extension;

                if ($this->fileServices->renameFile($oldFileName, $newFileName, 'products')) {
                    $this->productModel->update($data->id, ['cover_image' => $newFileName]);
                }
            }
        }

        return true;
    }

    public function getListProductKey(): BaseListResponse
    {
        $response = $this->productModel->findAll();

        $products = array_map(function ($data) {
            return $this->productDTOFactory->createResponse($data)->getIdentities(true);
        }, $response);

        return new BaseListResponse($products, []);
    }

    public function deleteProduct(string $slug): bool|BaseException
    {
        $product = $this->productModel->where('slug', $slug)->where('deleted_at', null)->first();

        if (!$product) {
            throw new BaseException(ProductError::PRODUCT_NOT_FOUND->value, 'PRODUCT_NOT_FOUND', 400);
        }

        if ($product['is_active'] == 1) {
            throw new BaseException(ProductError::PRODUCT_STILL_ACTIVE->value, 'PRODUCT_STILL_ACTIVE', 400);
        }

        return $this->productModel->delete((int)$product['id']);
    }

    public function toggleShowOnCatalog(string $slug): bool|BaseException
    {
        $product = $this->productModel->where('slug', $slug)->where('deleted_at', null)->first();

        if (!$product) {
            throw new BaseException(ProductError::PRODUCT_NOT_FOUND->value, 'PRODUCT_NOT_FOUND', 400);
        }

        if ($product['is_active'] == 0) {
            throw new BaseException(ProductError::PRODUCT_NOT_ACTIVE->value, 'PRODUCT_NOT_ACTIVE', 400);
        }

        return $this->productModel->update($product['id'], ['show_on_catalog' => (int)$product['show_on_catalog'] === 1 ? 0 : 1]);
    }
}
