<?php

namespace App\Core\Domains\Supplier\Repository\Implementation;

use App\Core\Domains\Supplier\DTOs\Frame\SupplierRequest;
use App\Core\Domains\Supplier\DTOs\Frame\SupplierResponse;
use App\Core\Domains\Supplier\DTOs\SupplierDTOFactory;
use App\Core\Domains\Supplier\Repository\Model\SupplierModel;
use App\Core\Domains\Supplier\Repository\SupplierRepository;
use App\Core\Shared\Enums\SupplierError;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\BaseListResponse;

class SupplierRepositoryImpl implements SupplierRepository
{
    protected SupplierModel $supplierModel;
    protected SupplierDTOFactory $supplierDTOFactory;

    public function __construct(
        SupplierModel $supplierModel,
        SupplierDTOFactory $supplierDTOFactory
    ) {
        $this->supplierModel = $supplierModel;
        $this->supplierDTOFactory = $supplierDTOFactory;
    }

    public function getAllSuppliers(BaseListParams $params): BaseListResponse
    {
        $request = $this->supplierModel->where('deleted_at', null)->paginate($params->limit, 'default', $params->page);

        $countData = $this->supplierModel->countAllResults();

        $response = array_map(function ($data) {
            return $this->supplierDTOFactory->createResponse($data);
        }, $request);

        $metadata = [
            'current_page' => $params->page,
            'total_count' => $countData,
            'total_pages' => ceil($countData / $params->limit),
            'limit' => $params->limit
        ];

        return new BaseListResponse($response, $metadata);
    }

    public function createSupplier(SupplierRequest $data): bool | BaseException
    {
        if ($this->supplierModel->where('slug', $data->slug)->first()) {
            throw new BaseException(SupplierError::SUPPLIER_ALREADY_EXISTS->value, 'SUPPLIER_ALREADY_EXISTS');
        }

        return $this->supplierModel->insert($data->getAssoc());
    }

    public function getSupplierBySlug(string $slug): BaseException | SupplierResponse
    {
        $supplierData = $this->supplierModel->where('slug', $slug)->where('deleted_at', null)->first();

        if (!$supplierData) {
            throw new BaseException(
                SupplierError::SUPPLIER_NOT_FOUND->value,
                'SUPPLIER_NOT_FOUND',
                400
            );
        }

        return $this->supplierDTOFactory->createResponse($supplierData);
    }

    public function updateSupplierById(SupplierRequest $data): bool | BaseException
    {
        $existingSupplier = $this->supplierModel->where('slug', $data->slug)->where('id !=', $data->id)->first();

        if ($existingSupplier) {
            throw new BaseException(
                SupplierError::SUPPLIER_ALREADY_EXISTS->value,
                'SUPPLIER_ALREADY_EXISTS',
                400
            );
        }

        return $this->supplierModel->update(
            $data->id,
            $data->getAssoc()
        );
    }

    public function deleteSupplier(string $slug): BaseException|bool
    {
        $existingSupplier = $this->supplierModel->where('slug', $slug)->first();

        if (!$existingSupplier) {
            throw new BaseException(
                SupplierError::SUPPLIER_NOT_FOUND->value,
                'SUPPLIER_NOT_FOUND',
                400
            );
        }

        return $this->supplierModel->where('slug', $slug)->delete();
    }
}
