<?php
declare(strict_types=1);
namespace PIEFrost\Common\Tests\Response;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use ParagonIE\CSPBuilder\CSPBuilder;
use PHPUnit\Framework\TestCase;
use PIEFrost\Common\Response\ContentSecurityPolicy;

class CSPTest extends TestCase
{
    public function testHasCSP()
    {
        $csp = (new CSPBuilder())
            ->addSource('style-src', 'https://paragonie.com');
        $decorator = new ContentSecurityPolicy($csp);
        $response = $decorator->decorate(
            new Response(200, ['Content-Type' => ['text/html']], 'Test')
        );
        $this->assertCount(1, $response->getHeader('Content-Security-Policy'));
    }
}
