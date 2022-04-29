<?php
declare(strict_types=1);
namespace PIEFrost\Common;

use PIEFrost\Common\Interfaces\HandlerInterface;
use PIEFrost\Common\Traits\SugarTrait;

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
