<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Core\Adapters\EnvAdapter;
use App\Core\Domains\User\DTOs\CreateUserRequest;
use Config\Services;

class CreateEmployeeController extends BaseController
{
    protected $createEmployeeUseCase;
    protected $ENV_ADAPTER;

    public function __construct()
    {
        $this->createEmployeeUseCase = Services::createEmployeeUseCase();
        $this->ENV_ADAPTER = new EnvAdapter();
    }

    public function create()
    {
        $metadata = [
            'title' => 'Create Employee | ' . $this->ENV_ADAPTER->getAppName(),
            'current' => 'Employee'
        ];

        return view('admin/employee/create/index', $metadata);
    }

    public function store()
    {
        $metadata = [
            'title' => 'Create Employee | ' . $this->ENV_ADAPTER->getAppName(),
            'current' => 'Employee'
        ];

        $validation = Services::validation();

        $validation->setRules([
            'username' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'phone_number' => 'required|numeric|min_length[10]|max_length[15]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return view('admin/employee/create/index', [
                'validation' => $validation
            ] + $metadata);
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'phone_number' => $this->request->getPost('phone_number'),
            'password' => $this->request->getPost('confirm_password'),
        ];

        $requestData = new CreateUserRequest($data);

        try {
            $this->createEmployeeUseCase->execute($requestData);

            return redirect()->to('/admin/list-employee')->with('success', 'Karyawan berhasil dibuat');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}