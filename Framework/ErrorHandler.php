<?php

namespace Framework;

use Throwable;

class ErrorHandler
{
    public static function handleError(int $errno, string $errstr, string $errfile, int $errline): void
    {
        $response = [
            'code' => $errno,
            'message' => $errstr,
            'file' => $errfile,
            'line' => $errline,
        ];


        if ($response["code"] === 2) {
            http_response_code(500);
            echo json_encode($response);
            exit;
        }

        exit;
    }

    public static function handleException(Throwable $exception): void
    {
        $response = [
            'code' => $exception->getCode(),
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
        ];

        if ($response["code"] === 2) {
            http_response_code(500);
            echo json_encode($response);
            exit;
        }

        exit;
    }

    public static function notFound(){
        http_response_code(404);
        loadview('error');
        return;
    }
}
