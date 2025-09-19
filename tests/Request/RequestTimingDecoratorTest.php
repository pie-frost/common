<?php
declare(strict_types=1);
namespace PIEFrost\Common\Tests\Request;

use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use PIEFrost\Common\Request\RequestTimingDecorator;

class RequestTimingDecoratorTest extends TestCase
{
    public function testHasTimestamp()
    {
        $decorator = new RequestTimingDecorator(microtime(true) - 30);
        $request = $decorator->decorate(
            new ServerRequest('GET', '/')
        );
        $got = $request->getAttribute('request_start_time');
        $this->assertNotEmpty($got);
        $this->assertLessThan(microtime(true), $got);
    }
}
