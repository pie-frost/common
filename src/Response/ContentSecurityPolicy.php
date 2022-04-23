<?php
declare(strict_types=1);
namespace PIEFrost\Common\Response;

use ParagonIE\CSPBuilder\CSPBuilder;
use PIEFrost\Common\Interfaces\ResponseDecoratorInterface;
use Psr\Http\Message\ResponseInterface;
use TypeError;

class ContentSecurityPolicy implements ResponseDecoratorInterface
{
    private CSPBuilder $builder;

    public function __construct(CSPBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function getBuilder(): CSPBuilder
    {
        return $this->builder;
    }

    public function decorate(ResponseInterface $response): ResponseInterface
    {
        $output = $this->builder->injectCSPHeader(clone $response);
        if (!($output instanceof ResponseInterface)) {
            throw new TypeError();
        }
        return $output;
    }
}
