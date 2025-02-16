<?php

namespace App\Core\Domains\Categories\DTOs\Frame;

use App\Core\Domains\Categories\Entities\CategoriesEntities;
use App\Core\Shared\Contracts\BaseDTOInterface;

interface CategoriesRequestInterface extends BaseDTOInterface
{
    public function getObj(): object;
}

class CategoriesRequest extends CategoriesEntities implements CategoriesRequestInterface
{
    public function __construct(array $data)
    {
        parent::__construct($data);
    }

    public function getAssoc(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
        ];
    }

    public function getObj(): object
    {
        return json_decode(json_encode($this->getAssoc()));
    }
}
