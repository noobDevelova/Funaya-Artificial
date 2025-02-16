<?php

namespace App\Core\Shared\Enums;

enum InventoryLogsRemarks: string
{
    case STOCK_IN = 'Pemasukan Stok Barang';
    case STOCK_OUT = 'Penjualan Produk';
}
