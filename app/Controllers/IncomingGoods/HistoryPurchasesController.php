<?php

namespace App\Controllers\IncomingGoods;

class HistoryPurchasesController extends IncomingGoodsController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $metadata = [
            'title' => 'Daftarkan Barang | ' . $this->ENV_ADAPTER->getAppName(),
            'current' => 'Barang Masuk',
            'subCurrent' => 'history'
        ];

        $indexData = $this->getHistoryIndexData();

        return view('incoming-goods/history/index', [
            'purchases' => $indexData['purchases'],
            'pagination' => $indexData['pagination'],
            'error_message' => $indexData['error_message']
        ] + $metadata);
    }
}
