<?php

namespace App\Controllers\IncomingGoods;

use App\Core\Domains\Products\Usecases\GetProductUseCase;
use App\Core\Domains\Purchases\DTOs\PurchasesDTOFactory;
use App\Core\Domains\Purchases\Usecases\CreatePurchaseUseCase;
use App\Core\Domains\Supplier\Usecases\GetListSupplierUseCase;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\Response;
use App\Schemas\CreatePurchaseSchema;
use Config\Services;

class ManageStockController extends IncomingGoodsController
{
    protected PurchasesDTOFactory $purchasesDTOFactory;
    protected GetProductUseCase $getProductUseCase;
    protected GetListSupplierUseCase $getListSupplierUseCase;
    protected CreatePurchaseUseCase $createPurchaseUseCase;

    public function __construct()
    {
        parent::__construct();

        $this->purchasesDTOFactory = Services::purchasesDTOFactory();
        $this->getProductUseCase = Services::getProductUseCase();
        $this->getListSupplierUseCase = Services::getListSupplierUseCase();
        $this->createPurchaseUseCase = Services::createPurchaseUseCase();
    }

    private function getSuppliers()
    {
        $params = new BaseListParams([
            'page' => 1,
            'limit' => 1000,
        ]);

        try {
            $response = $this->getListSupplierUseCase->execute($params);

            return [
                'suppliers' => $response->getItems(),
                'pagination' => $response->getPagination(),
                'error_message' => ''
            ];
        } catch (BaseException $e) {
            return [
                'suppliers' => [],
                'pagination' => [],
                'error_message' => $e->getMessage()
            ];
        }
    }

    public function index()
    {
        $metadata = [
            'title' => 'Stok Produk | ' . $this->ENV_ADAPTER->getAppName(),
            'current' => 'Barang Masuk',
            'subCurrent' => 'stock'
        ];

        $indexData = $this->getStockIndexData(6);

        return view('incoming-goods/stock/list/index', [
            'products' => $indexData['products'],
            'pagination' => $indexData['pagination'],
            'error_message' => $indexData['error_message']
        ] + $metadata);
    }

    public function create(string $slug): string
    {
        $metadata = [
            'title' => 'Buat Pembelian | ' . $this->ENV_ADAPTER->getAppName(),
            'current' => 'Barang Masuk',
        ];

        $product = $this->getProductUseCase->execute($slug)->getObj();
        $suppliers = $this->getSuppliers()['suppliers'];

        return view('incoming-goods/stock/create/index', [
            'product' => $product,
            'suppliers' => $suppliers
        ] + $metadata);
    }

    public function store()
    {
        $request = $this->request->getJSON(true);

        log_message('debug', 'Request Data: ' . print_r($request, true));

        $this->validation->setRules(CreatePurchaseSchema::getRules());

        if (!$this->validation->run($request)) {
            return Response::error(
                "Invalid Input Data",
                'INVALID_INPUT',
                400,
                $this->validation->getErrors()
            );
        }

        if (!$request['product_id']) {
            return Response::error(
                "Invalid Input Data",
                'PRODUCT_ID_NOT_DEFINED',
                400,
                []
            );
        }

        try {
            $dto = $this->purchasesDTOFactory->createRequest($request);

            $this->createPurchaseUseCase->execute($dto);

            return Response::success(
                'Success Create Purchase!',
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
}
