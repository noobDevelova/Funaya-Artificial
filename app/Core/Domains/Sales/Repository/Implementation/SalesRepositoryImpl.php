<?php

namespace App\Core\Domains\Sales\Repository\Implementation;

use App\Core\Domains\Products\Repository\Model\ProductModel;
use App\Core\Domains\Sales\DTOs\Frame\SalesRequest;
use App\Core\Domains\Sales\DTOs\SalesDTOFactory;
use App\Core\Domains\Sales\Repository\Model\SalesItemsModel;
use App\Core\Domains\Sales\Repository\Model\SalesModel;
use App\Core\Domains\Sales\Repository\SalesRepository;
use App\Core\Shared\Enums\ProductError;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\BaseListResponse;

class SalesRepositoryImpl implements SalesRepository
{
    protected SalesModel $salesModel;
    protected SalesItemsModel $salesItemsModel;
    protected ProductModel $productModel;
    protected SalesDTOFactory $salesDTOFactory;

    public function __construct(
        SalesModel $salesModel,
        SalesItemsModel $salesItemsModel,
        ProductModel $productModel,
        SalesDTOFactory $salesDTOFactory
    ) {
        $this->salesModel = $salesModel;
        $this->salesItemsModel = $salesItemsModel;
        $this->productModel = $productModel;
        $this->salesDTOFactory = $salesDTOFactory;
    }

    private function updateProductStock(int $productId, int $quantitySold): void
    {
        $product = $this->productModel->find($productId);

        if ($product) {
            $newStock = $product['stock'] - $quantitySold;

            if ($newStock < 0) {
                throw new BaseException(ProductError::PRODUCT_OUT_OF_STOCK->value, 'PRODUCT_OUT_OF_STOCK', 400);
            }

            $this->productModel->update($productId, ['stock' => $newStock]);
        } else {
            throw new BaseException(ProductError::PRODUCT_NOT_FOUND->value, 'PRODUCT_NOT_FOUND', 400);
        }
    }

    public function createSalesReport(SalesRequest $data): bool|BaseException
    {
        $saleId = $this->salesModel->insert($data->getSales());

        $data->setSaleIdForItems($saleId);

        $this->salesItemsModel->insertBatch($data->getSalesItems());

        foreach ($data->salesItems as $item) {
            $this->updateProductStock($item->productId, $item->quantity);
        }

        return true;
    }

    public function getSalesReports(BaseListParams $params): BaseListResponse
    {
        $builder = $this->salesModel->select('sales.*, u.id AS user_id, u.username as username')->join('users u', 'u.id = sales.created_by', 'left');

        $reports = $builder->paginate($params->limit, 'default', $params->page);

        $countData = $this->salesModel->countAllResults();

        return new BaseListResponse(json_decode(json_encode($reports)), [
            'current_page' => $params->page,
            'total_count' => $countData,
            'total_pages' => ceil($countData / $params->limit),
            'limit' => $params->limit
        ]);
    }
}
