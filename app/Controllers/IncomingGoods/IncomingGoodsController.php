<?php

namespace App\Controllers\IncomingGoods;

use App\Controllers\BaseController;
use App\Core\Adapters\EnvAdapter;
use App\Core\Domains\Products\Usecases\GetListProductsUseCase;
use App\Core\Domains\Purchases\Usecases\GetListPurchasesUseCase;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use Config\Services;

class IncomingGoodsController extends BaseController
{
    protected $ENV_ADAPTER;

    protected $validation;

    protected GetListProductsUseCase $getListProductsUseCase;
    protected GetListPurchasesUseCase $getListPurchasesUseCase;

    public function __construct()
    {
        $this->ENV_ADAPTER = new EnvAdapter();

        $this->validation = Services::validation();

        $this->getListProductsUseCase = Services::getListProductUseCase();
        $this->getListPurchasesUseCase = Services::getListPurchasesUseCase();
    }

    protected function getStockIndexData(int $limit = 10)
    {
        $params = new BaseListParams([
            'page' => (int) $this->request->getVar('page') ?: 1,
            'limit' => $limit
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

    protected function getHistoryIndexData(int $limit = 10)
    {
        $params = new BaseListParams([
            'page' => (int) $this->request->getVar('page') ?: 1,
            'limit' => $limit
        ]);

        try {
            $response = $this->getListPurchasesUseCase->execute($params);

            return [
                'purchases' => $response->getItems(),
                'pagination' => $response->getPagination(),
                'error_message' => ''
            ];
        } catch (BaseException $e) {
            return [
                'purchases' => [],
                'pagination' => [],
                'error_message' => $e->getErrorMessage()
            ];
        }
    }

    public function index()
    {
        return redirect()->to('/incoming-goods/manage-stock');
    }
}
