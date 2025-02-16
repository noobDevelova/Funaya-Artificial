<?php

namespace App\Core\Domains\Categories\DTOs\Implementation;

use App\Core\Domains\Categories\DTOs\CategoriesDTOFactory;
use App\Core\Domains\Categories\DTOs\Frame\CategoriesRequest;
use App\Core\Domains\Categories\DTOs\Frame\CategoriesResponse;

class CategoriesDTOFactoryImpl implements CategoriesDTOFactory
{
    public function createResponse(array $data): CategoriesResponse
    {
        return new CategoriesResponse($data);
    }
    public function createRequest(array $data): CategoriesRequest
    {
        return new CategoriesRequest($data);
    }
}
