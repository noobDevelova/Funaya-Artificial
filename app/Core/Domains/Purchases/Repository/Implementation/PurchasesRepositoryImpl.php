<?php

namespace App\Core\Domains\Purchases\Repository\Implementation;

use App\Core\Domains\Inventory\Model\InventoryModel;
use App\Core\Domains\Products\Repository\Model\ProductModel;
use App\Core\Domains\Purchases\DTOs\Frame\PurchaseRequest;
use App\Core\Domains\Purchases\DTOs\PurchasesDTOFactory;
use App\Core\Domains\Purchases\Repository\Model\PurchaseItemsModel;
use App\Core\Domains\Purchases\Repository\Model\PurchasesModel;
use App\Core\Domains\Purchases\Repository\PurchasesRepository;
use App\Core\Shared\Enums\InventoryLogsRemarks;
use App\Core\Shared\Enums\InventoryLogsType;
use App\Core\Shared\Enums\PurchaseError;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\BaseListResponse;

class PurchasesRepositoryImpl implements PurchasesRepository
{
    protected ProductModel $productModel;
    protected PurchasesModel $purchasesModel;
    protected PurchaseItemsModel $purchaseItemsModel;
    protected InventoryModel $inventoryModel;
    protected PurchasesDTOFactory $purchasesDTOFactory;

    public function __construct(
        ProductModel $productModel,
        PurchasesModel $purchasesModel,
        PurchaseItemsModel $purchaseItemsModel,
        InventoryModel $inventoryModel,
        PurchasesDTOFactory $purchasesDTOFactory
    ) {
        $this->productModel = $productModel;
        $this->purchasesModel = $purchasesModel;
        $this->purchaseItemsModel = $purchaseItemsModel;
        $this->inventoryModel = $inventoryModel;
        $this->purchasesDTOFactory = $purchasesDTOFactory;
    }

    public function createPurchase(PurchaseRequest $data): bool|BaseException
    {
        $product = $this->productModel->where('id', $data->productId)->first();

        if (!$product) {
            throw new BaseException(
                PurchaseError::PURCHASE_PRODUCT_NOT_FOUND->value,
                'PURCHASE_PRODUCT_NOT_FOUND',
                400
            );
        }

        $purchaseData = $data->getAssoc();
        $purchaseData['created_by'] = session()->get('id');

        $purchaseId = $this->purchasesModel->insert($purchaseData);

        if (!$purchaseId) {
            throw new BaseException(
                PurchaseError::PURHASE_FAILED->value,
                'PURHASE_FAILED',
                400
            );
        }

        $purchaseItemData = $data->getItemAssoc();
        $purchaseItemData['purchase_id'] = $purchaseId;

        $this->purchaseItemsModel->insert($purchaseItemData);

        $this->productModel->where('id', $data->productId)
            ->set('stock', $data->quantity)
            ->set('updated_by', $purchaseData['created_by'])
            ->set('is_active', 1)
            ->update();

        return $this->inventoryModel->insert([
            'product_id' => $data->productId,
            'activity_type' => InventoryLogsType::STOCK_IN->value,
            'quantity' => $data->quantity,
            'remarks' => InventoryLogsRemarks::STOCK_IN->value,
            'logged_by' => $purchaseData['created_by']
        ]);
    }

    public function getListPurchases(BaseListParams $params): BaseListResponse
    {
        $builder = $this->purchasesModel
            ->join('purchase_items', 'purchase_items.purchase_id = purchases.id')
            ->join('products', 'products.id = purchase_items.product_id')
            ->join('users', 'users.id = purchases.created_by')
            ->join('categories', 'categories.id = products.category_id')
            ->join('suppliers', 'suppliers.id = purchases.supplier_id')
            ->select('purchases.id, 
                  purchases.*, 
                  purchase_items.quantity, 
                  purchase_items.price, 
                  purchase_items.total, 
                  suppliers.name as supplier_name, 
                  products.id as product_id, 
                  products.name as product_name, 
                  products.cover_image as product_image, 
                  categories.name as product_category, 
                  users.username');

        $purchases = $builder->paginate($params->limit, 'default', $params->page);

        $countData = $this->purchasesModel->countAllResults();

        $response = array_map(function ($data) {
            return $this->purchasesDTOFactory->createResponse($data)->getListItems(true);
        }, $purchases);

        return new BaseListResponse($response, [
            'current_page' => $params->page,
            'total_count' => $countData,
            'total_pages' => ceil($countData / $params->limit),
            'limit' => $params->limit
        ]);
    }
}
