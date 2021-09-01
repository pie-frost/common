<?php
namespace PIEFrost\Common\Tests;

use GuzzleHttp\Psr7\Response;
use PIEFrost\Common\BaseHandler;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

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

    public function __invoke(RequestInterface $request): ResponseInterface
    {
        return new Response(200, [
            'Content-Type' => ['text/plain']
        ],json_encode($this->vars));
    }
}
