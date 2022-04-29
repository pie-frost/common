<?php
declare(strict_types=1);
namespace PIEFrost\Common\Interfaces;

use PIEFrost\Common\RuntimeState;
use Psr\Http\Server\RequestHandlerInterface;

interface HandlerInterface extends RequestHandlerInterface
{

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
