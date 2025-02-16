<?php

namespace App\Core\Shared\Http;

interface BaseResponseInterface
{
    public function getData(): array;
    public function getErrorMessage(): ?string;
}

class BaseResponse implements BaseResponseInterface
{
    public array $data;
    public ?string $error_message;

    public function __construct(array $data = [], string $error_message = null)
    {
        $this->data = $data;
        $this->error_message = $error_message;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getErrorMessage(): ?string
    {
        return $this->error_message;
    }
}
