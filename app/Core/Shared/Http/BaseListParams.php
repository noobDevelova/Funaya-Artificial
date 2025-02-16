<?php

namespace App\Core\Shared\Http;

class BaseListParams
{
    public int $limit;
    public int $page;

    public ?int $offset;

    public function __construct(array $params)
    {
        $this->limit = $params['limit'];
        $this->page = $params['page'];
        $this->offset = $params['offset'] ?? null;
    }
}
