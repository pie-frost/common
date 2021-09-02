<?php
declare(strict_types=1);
namespace PIEFrost\Common\ValueObjects;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

class Redirect
{
    protected int $status;
    protected string|UriInterface $url;
    protected string $message;

    public function __construct(
        UriInterface|string $url,
        string $message = '',
        int $status = 301
    ) {
        $this->url = $url;
        $this->message = $message;
        $this->status = $status;
    }

    public function respond(): ResponseInterface
    {
        return new Response(
            $this->status,
            ['Location' => [(string) $this->url]],
            $this->message
        );
    }
}
