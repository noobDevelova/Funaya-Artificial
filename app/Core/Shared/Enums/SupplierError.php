<?php

namespace App\Core\Shared\Enums;

enum SupplierError: string
{
    case SUPPLIER_ALREADY_EXISTS = "Supplier Is Already Exists.";
    case SUPPLIER_NOT_FOUND = "Supplier Did Not Exists.";
}
