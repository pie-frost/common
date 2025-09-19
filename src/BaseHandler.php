<?php
declare(strict_types=1);
namespace PIEFrost\Common;

use PIEFrost\Common\Exceptions\RequestException;
use PIEFrost\Common\Interfaces\HandlerInterface;
use PIEFrost\Common\Traits\SugarTrait;
use Psr\Http\Message\{
    ResponseInterface,
    ServerRequestInterface
};

abstract class BaseHandler implements HandlerInterface
{
    use SugarTrait;

    protected RuntimeState $state;
    protected array $vars = [];

    /**
     * Override me! Called before handle();
     *
     * @return static
     */
    public function init(): static
    {
        /* NOP */
        return $this;
    }

    /**
     * Oveerride this in derived classes.
     *
     * @throws RequestException
     */
    public function preprocess(ServerRequestInterface $request): ServerRequestInterface
    {
        return $request;
    }

    /**
     * Override me!
     *
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function decorate(ResponseInterface $response): ResponseInterface
    {
        return $response;
    }

    /**
     * @param RuntimeState $state
     * @return self
     */
    public function injectState(RuntimeState $state): self
    {
        $this->state = $state;
        return $this;
    }

    public function setVars(array $vars): self
    {
        $this->vars = $vars;
        return $this;
    }
}
