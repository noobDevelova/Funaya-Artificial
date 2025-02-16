<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Core\Adapters\EnvAdapter;

class DashboardController extends BaseController
{
    protected $ENV_ADAPTER;

    public function __construct()
    {
        $this->ENV_ADAPTER = new EnvAdapter;
    }

    public function index()
    {
        $metadata = [
            'title' => 'Dashboard | ' . $this->ENV_ADAPTER->getAppName(),
            'current' => 'Dashboard'
        ];

        return view('dashboard/index', $metadata);
    }
}
