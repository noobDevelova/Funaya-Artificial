<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Core\Adapters\EnvAdapter;
use Config\Services;

class ListEmployeeController extends BaseController
{
    protected $getListEmployeesUseCase;
    protected $deleteEmployeeUseCase;
    protected $ENV_ADAPTER;

    public function __construct()
    {
        $this->getListEmployeesUseCase = Services::getListEmployeesUseCase();
        $this->deleteEmployeeUseCase = Services::deleteEmployeeUseCase();

        $this->ENV_ADAPTER = new EnvAdapter();
    }

    public function index()
    {
        $metadata = [
            'title' => 'List Karyawan | ' . $this->ENV_ADAPTER->getAppName(),
            'current' => 'Employee',
        ];

        $limit = 10;
        $page = $this->request->getGet('page') ?? 1;

        $result = $this->getListEmployeesUseCase->execute($limit, $page);

        return view('admin/employee/list/index', [
            'employees' => $result['employees'],
            'totalPages' => $result['totalPages'],
            'currentPage' => $result['currentPage'],
            'totalCount' => $result['totalEmployees'],
            'limit' => $limit,
        ] + $metadata);
    }

    public function delete()
    {

        $decodedData = $this->request->getJSON(true); // Mengembalikan data sebagai array asosiatif
        $employeeId = $decodedData['id'] ?? null;

        if (!$employeeId) {
            return $this->response->setJSON(['error' => 'Employee ID is required'])->setStatusCode(400);
        }

        $result = $this->deleteEmployeeUseCase->execute((int)$employeeId);

        if ($result) {
            return $this->response->setJSON(['message' => 'Employee deleted successfully'])->setStatusCode(200);
        }

        return $this->response->setJSON(['error' => 'Failed to delete employee'])->setStatusCode(500);
    }
}
