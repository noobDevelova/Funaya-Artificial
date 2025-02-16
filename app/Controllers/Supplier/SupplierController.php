<?php

namespace App\Controllers\Supplier;

use App\Core\Adapters\EnvAdapter;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\Response;
use App\Controllers\BaseController;
use App\Core\Domains\Supplier\DTOs\SupplierDTOFactory;
use App\Core\Domains\Supplier\Usecases\CreateSupplierUseCase;
use App\Core\Domains\Supplier\Usecases\DeleteSupplierUseCase;
use App\Core\Domains\Supplier\Usecases\GetListSupplierUseCase;
use App\Core\Domains\Supplier\Usecases\GetSupplierUseCase;
use App\Core\Domains\Supplier\Usecases\UpdateSupplierUseCase;
use App\Helpers\CreateSlug;
use App\Schemas\CreateSupplierSchema;
use App\Schemas\EditSupplierSchema;
use Config\Services;

class SupplierController extends BaseController
{
    protected $ENV_ADAPTER;
    protected $validation;

    protected SupplierDTOFactory $supploSupplierDTOFactory;

    protected GetListSupplierUseCase $getListSupplierUseCase;
    protected CreateSupplierUseCase $createSupplierUseCase;
    protected GetSupplierUseCase $getSupplierUseCase;
    protected UpdateSupplierUseCase $updateSupplierUseCase;
    protected DeleteSupplierUseCase $deleteSupplierUseCase;

    public function __construct()
    {
        $this->ENV_ADAPTER = new EnvAdapter();
        $this->validation = Services::validation();

        $this->supploSupplierDTOFactory = Services::supplierDTOFactory();

        $this->getListSupplierUseCase = Services::getListSupplierUseCase();
        $this->createSupplierUseCase = Services::createSupplierUseCase();
        $this->getSupplierUseCase = Services::getSupplierUseCase();
        $this->updateSupplierUseCase = Services::updateSupplierUseCase();
        $this->deleteSupplierUseCase = Services::deleteSupplierUseCase();
    }

    private function getIndexData()
    {
        $params = new BaseListParams([
            'page' => (int) $this->request->getVar('page') ?: 1,
            'limit' => (int) $this->request->getVar('limit') ?: 10
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
            'title' => 'Supplier | ' . $this->ENV_ADAPTER->getAppName(),
            'current' => 'Supplier',
        ];

        $indexData = $this->getIndexData();

        return view('supplier/index', [
            'suppliers' => $indexData['suppliers'],
            'pagination' => $indexData['pagination'],
            'error_message' => $indexData['error_message'],
        ] + $metadata);
    }

    public function create()
    {

        $metadata = [
            'title' => 'Tambah Supplier | ' . $this->ENV_ADAPTER->getAppName(),
            'current' => 'Supplier',
        ];

        return view('supplier/create/index', $metadata);
    }

    public function store()
    {
        $requestData = $this->request->getJSON(true);

        $this->validation->setRules(CreateSupplierSchema::getRules());

        if (!$this->validation->run($requestData)) {
            return Response::error(
                "Invalid Input Data",
                'INVALID_INPUT',
                400,
                $this->validation->getErrors()
            );
        }

        try {
            $requestData['slug'] = CreateSlug::create($requestData['name']);

            $dto = $this->supploSupplierDTOFactory->createRequest($requestData);

            return Response::success(
                "Success Create Supplier",
                $dto->getAssoc(),
                200
            );
        } catch (BaseException $e) {
            return Response::error(
                $e->getMessage(),
                $e->getCode(),
                400,
                []
            );
        }
    }

    public function getSupplier(string $slug)
    {
        try {
            $supplier = $this->getSupplierUseCase->execute($slug);

            return Response::success(
                'Success Get Categories!',
                $supplier->getAssoc(),
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

        $this->validation->setRules(EditSupplierSchema::getRules());

        if (!$this->validation->run($requestData)) {
            return Response::error(
                "Invalid Input Data",
                'INVALID_INPUT',
                400,
                $this->validation->getErrors()
            );
        }

        try {
            $requestData['slug'] = CreateSlug::create($requestData['name']);

            $dto = $this->supploSupplierDTOFactory->createRequest($requestData);

            $this->updateSupplierUseCase->execute($dto);

            return Response::success(
                'Success Update Supplier!',
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
        $requestData = $this->request->getJSON(true);

        if (!$requestData['slug']) {
            return Response::error(
                "Slug is not defined.",
                'INVALID_INPUT',
                400,
                []
            );
        }

        try {
            $this->deleteSupplierUseCase->execute($requestData['slug']);

            return Response::success(
                'Success Delete Supplier!',
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
