<?php
declare(strict_types=1);
namespace PIEFrost\Common;

use GuzzleHttp\Psr7\Response;

class Utilities
{
    public static function jsonResponse(
        array|object $data,
        array $headers = [],
        int $statusCode = 200
    ): Response {
        $headers['Content-Type'] = 'application/json';
        return new Response(
            $statusCode,
            $headers,
            json_encode($data, JSON_PRETTY_PRINT)
        );
    }

    public static function htmlResponse(
        string $document,
        array $headers = [],
        int $statusCode = 200
    ): Response {
        return new Response(
            $statusCode,
            $headers,
            $document
        );
    }
}
