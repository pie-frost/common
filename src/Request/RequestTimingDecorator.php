<?php
declare(strict_types=1);
namespace PIEFrost\Common\Request;

use PIEFrost\Common\Interfaces\ServerRequestDecoratorInterface;
use Psr\Http\Message\ServerRequestInterface;

class RequestTimingDecorator implements ServerRequestDecoratorInterface
{

    public function __construct(protected ?float $time = null)
    {
        if (is_null($this->time)) {
            $time = microtime(true);
        }
    }
    public function decorate(ServerRequestInterface $request): ServerRequestInterface
    {
        return $request->withAttribute('request_start_time', $this->time);
    }
}
