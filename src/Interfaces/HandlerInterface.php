<?php
declare(strict_types=1);
namespace PIEFrost\Common\Interfaces;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface HandlerInterface
{
    /**
     * @param array $vars
     * @return self
     */
    public function setVars(array $vars): self;

    public function __invoke(RequestInterface $request): ResponseInterface;
}
