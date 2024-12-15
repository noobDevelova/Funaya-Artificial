<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Core\Adapters\EnvAdapter;

class DashboardController extends BaseController
{

    public function index()
    {

        $ENV_ADAPTER = new EnvAdapter();

        $metadata = [
            'title' => 'Dashboard Admin | ' . $ENV_ADAPTER->getAppName(),
            'current' => 'Dashboard'
        ];

        return view('admin/dashboard/index', $metadata);
    }
}