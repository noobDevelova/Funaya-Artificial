<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Core\Adapters\EnvAdapter;

class AdminController extends BaseController
{

    protected $ENV_ADAPTER;

    public function __construct()
    {
        $this->ENV_ADAPTER = new EnvAdapter();
    }

    public function index()
    {
        $metadata = [
            'title' => 'Dashboard Admin | ' . $this->ENV_ADAPTER->getAppName(),
            'current' => 'Dashboard'
        ];

        return view('admin/dashboard/index', $metadata);
    }
}