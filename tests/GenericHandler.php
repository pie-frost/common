<?php
namespace PIEFrost\Common\Tests;

use GuzzleHttp\Psr7\Response;
use PIEFrost\Common\BaseHandler;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GenericHandler extends BaseHandler
{
    public array $vars = [];
    /**
     * @param array $vars
     * @return self
     */
    public function setVars(array $vars): self
    {
        $this->vars = $vars;
        return $this;
    }

    /**
     * Handles a request and produces a response.
     *
     * May call other collaborating code to generate the response.
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(200, [
            'Content-Type' => ['text/plain']
        ],json_encode($this->vars));
    }
}
