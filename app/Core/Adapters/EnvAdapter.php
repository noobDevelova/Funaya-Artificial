<?php

namespace App\Core\Adapters;

class EnvAdapter
{
    public function getDatabaseConfig()
    {
        return [
            'hostname' => getenv('database.default.hostname'),
            'username' => getenv('database.default.username'),
            'password' => getenv('database.default.password'),
            'database' => getenv('database.default.database'),
            'port' => (int) getenv('database.default.port'),
        ];
    }

    public function getBaseUrl()
    {
        return getenv('app.baseURL');
    }

    public function getAppName()
    {
        return getenv('app.name');
    }
}