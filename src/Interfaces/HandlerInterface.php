<?php
declare(strict_types=1);
namespace PIEFrost\Common\Interfaces;

use PIEFrost\Common\Exceptions\RequestException;
use PIEFrost\Common\RuntimeState;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

interface HandlerInterface extends RequestHandlerInterface
{
    /**
     * Override me! Called before handle();
     *
     * @throws RequestException
     */
    public function preprocess(ServerRequestInterface $request): ServerRequestInterface;

    /**
     * Override me! Called after handle();
     *
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function decorate(ResponseInterface $response): ResponseInterface;

    /**
     * Override me! Called before handle();
     *
     * @return static
     */
    public function init(): static;

    /**
     * @param RuntimeState $state
     * @return self
     */
    public function injectState(RuntimeState $state): self;

    /**
     * @param array $vars
     * @return self
     */
    public function setVars(array $vars): self;
}
