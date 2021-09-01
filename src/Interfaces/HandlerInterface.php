<?php
declare(strict_types=1);
namespace PIEFrost\Common\Interfaces;

use Psr\Http\Server\RequestHandlerInterface;

interface HandlerInterface extends RequestHandlerInterface
{
    /**
     * @param array $vars
     * @return self
     */
    public function setVars(array $vars): self;
}
