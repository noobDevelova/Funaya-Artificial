<?php

namespace App\Core\Shared\Enums;

enum InventoryLogsType: string
{
    case STOCK_IN = 'stock_in';
    case STOCK_OUT = 'stock_out';
    case ADJUSTMENT = 'adjustment';
}
