<?php
declare(strict_types=1);
namespace PIEFrost\Common\Interfaces;

interface HandlerInterface
{
    /**
     * @param array $vars
     * @return self
     */
    public function setVars(array $vars): self;
}
