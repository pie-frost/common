<?php
declare(strict_types=1);
namespace PIEFrost\Common;
use PIEFrost\Common\Interfaces\HandlerInterface;

abstract class BaseHandler implements HandlerInterface
{
    protected array $vars = [];

    public function setVars(array $vars): self
    {
        $this->vars = $vars;
        return $this;
    }
}
