<?php

namespace App\Core\Domains\Categories\DTOs;

use App\Core\Domains\Categories\DTOs\Frame\CategoriesRequest;
use App\Core\Domains\Categories\DTOs\Frame\CategoriesResponse;

interface CategoriesDTOFactory
{
    public function createResponse(array $data): CategoriesResponse;

    public function createRequest(array $data): CategoriesRequest;
}
