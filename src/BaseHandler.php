<?php
declare(strict_types=1);
namespace PIEFrost\Common;
use PIEFrost\Common\Interfaces\HandlerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class BaseHandler implements HandlerInterface
{
    protected array $vars = [];

    public function setVars(array $vars): self
    {
        $this->vars = $vars;
        return $this;
    }

    abstract public function __invoke(RequestInterface $request): ResponseInterface;
}
