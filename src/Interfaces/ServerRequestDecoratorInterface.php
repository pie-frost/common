<?php
declare(strict_types=1);
namespace PIEFrost\Common\Interfaces;

use Psr\Http\Message\ServerRequestInterface;

interface ServerRequestDecoratorInterface
{
    public function decorate(ServerRequestInterface $request): ServerRequestInterface;
}
