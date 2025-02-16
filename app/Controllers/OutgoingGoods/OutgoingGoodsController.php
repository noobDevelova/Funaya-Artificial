<?php

namespace App\Controllers\OutgoingGoods;

use App\Controllers\BaseController;
use App\Core\Adapters\EnvAdapter;
use App\Core\Domains\Products\Usecases\GetListProductsKeyUseCase;
use App\Core\Domains\Sales\DTOs\SalesDTOFactory;
use App\Core\Domains\Sales\Usecases\CreateSalesReportUseCase;
use App\Core\Domains\Sales\Usecases\GetSalesReportsUseCase;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\Response;
use Config\Services;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class OutgoingGoodsController extends BaseController
{
    protected $ENV_ADAPTER;
    protected SalesDTOFactory $salesDTOFactory;

    protected GetListProductsKeyUseCase $getListProductsKeyUseCase;
    protected CreateSalesReportUseCase $createSalesReportUseCase;
    protected GetSalesReportsUseCase $getSalesReportsUseCase;

    public function __construct()
    {
        $this->ENV_ADAPTER = new EnvAdapter();
        $this->getListProductsKeyUseCase = Services::getListProductsKeyUseCase();
        $this->salesDTOFactory = Services::salesDTOFactory();
        $this->createSalesReportUseCase = Services::createSalesReportUseCase();
        $this->getSalesReportsUseCase = Services::getSalesReportsUseCase();
    }

    private function getIndexData()
    {
        $params = new BaseListParams([
            'page' => (int) $this->request->getVar('page') ?: 1,
            'limit' => 10
        ]);

        try {
            $response = $this->getSalesReportsUseCase->execute($params);

            return [
                'reports' => $response->getItems(),
                'pagination' => $response->getPagination(),
                'error_message' => ''
            ];
        } catch (BaseException $e) {
            return [
                'reports' => [],
                'pagination' => [],
                'error_message' => $e->getMessage()
            ];
        }
    }

    public function index()
    {
        $metadata = [
            'title' => 'Barang Keluar | ' . $this->ENV_ADAPTER->getAppName(),
            'current' => 'Barang Keluar'
        ];

        $indexData = $this->getIndexData();


        return view('outgoing-goods/list/index', [
            'reports' => $indexData['reports'],
            'pagination' => $indexData['pagination'],
            'error_message' => $indexData['error_message']
        ] + $metadata);
    }

    public function create()
    {
        $metadata = [
            'title' => 'Buat Laporan | ' . $this->ENV_ADAPTER->getAppName(),
            'current' => 'Barang Keluar'
        ];

        $response = $this->getListProductsKeyUseCase->execute();
        $products = $response->getItems();

        return view('outgoing-goods/create/index', compact('products') + $metadata);
    }

    public function store()
    {
        $request = $this->request->getJSON(true);

        if (!$request) {
            return Response::error(
                "Invalid Input Data",
                'INVALID_INPUT',
                400,
                []
            );
        }

        $request['created_by'] = session()->get('id');

        try {
            $dto = $this->salesDTOFactory->createRequest($request);

            $this->createSalesReportUseCase->execute($dto);

            return Response::success(
                'Success Create Report!',
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

    public function export()
    {
        $spreadsheet = new Spreadsheet();
    }
}
