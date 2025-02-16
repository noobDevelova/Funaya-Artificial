<?php

namespace App\Core\Shared\Http;

interface BaseListResponseInterface
{
    public function getItems(): array;

    public function getPagination(): array;

    public function getErrorMessage(): ?string;
}

class BaseListResponse implements BaseListResponseInterface
{
    public array $items;
    public array $pagination;
    public ?string $error_message;

    public function __construct(array $items = [], array $pagination, string $error_message = null)
    {
        $this->items = $items;
        $this->pagination = $pagination;
        $this->error_message = $error_message;
    }
    public function getItems(): array
    {
        return $this->items;
    }

    public function getPagination(): array
    {
        return $this->pagination;
    }

    public function getErrorMessage(): ?string
    {
        return $this->error_message;
    }
}
