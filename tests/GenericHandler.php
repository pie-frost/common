<?php
namespace PIEFrost\Common\Tests;

use PIEFrost\Common\Interfaces\HandlerInterface;

class GenericHandler implements HandlerInterface
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
}
