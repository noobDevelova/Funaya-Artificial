<?php

namespace App\Core\Shared\Http;

interface ResponseInterface
{
    public static function success(string $message, array $data = []);

    public static function error(string $message, string $error_code = '', int $httpCode, array $errors = []);
}


class Response implements ResponseInterface
{
    public static function success(string $message = 'Success', array $data = [], int $httpCode = 200)
    {
        return response()->setStatusCode($httpCode)->setJSON([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ]);
    }

    public static function error(string $message = 'An error occurred', string $error_code = '', int $httpCode = 400, array $errors = [])
    {
        return response()->setStatusCode($httpCode)->setJSON([
            'status' => 'error',
            'message' => $message,
            'error_code' => $error_code,
            'errors' => $errors
        ]);
    }
}
