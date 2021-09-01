<?php
declare(strict_types=1);
namespace PIEFrost\Common\Interfaces;

use Psr\Http\Message\ResponseInterface;

interface ResponseDecoratorInterface
{
    public function decorate(ResponseInterface $response): ResponseInterface;
}
