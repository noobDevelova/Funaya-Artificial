<?php

namespace App\Core\Shared\Exception;

use Exception;

class BaseException extends Exception
{
    protected string $errorCode;
    public function __construct(
        string $message,
        string $errorCode,
        int $code = 0,
    ) {
        parent::__construct($message, $code);
        $this->errorCode = $errorCode;
    }

    public function getErrorCode(): string
    {
        return $this->errorCode;
    }
    public function getErrorMessage(): string
    {
        return $this->message;
    }
}
