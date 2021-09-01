<?php
declare(strict_types=1);
namespace PIEFrost\Common\Tests;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;
use PIEFrost\Common\Router;
use function FastRoute\simpleDispatcher;

class RouterTest extends TestCase
{
    protected function getRoutes(): Dispatcher
    {
        return simpleDispatcher(function(RouteCollector $r) {
            $r->addRoute('GET', '/articles/{id:\d+}', GenericHandler::class);
            $r->addRoute(['GET', 'POST'], '/articles', GenericHandler::class);
            $r->addRoute('GET', '/', GenericHandler::class);
        });
    }

    public function getRequestPaths(): array
    {
        return [
            ['GET', '/articles/123', ['id' => '123']],
            ['GET', '/articles', []],
            ['POST', '/articles', []],
            ['GET', '/', []],
        ];
    }

    /**
     * @dataProvider getRequestPaths
     */
    public function testArray(string $method, string $uri, array $vars)
    {
        $routes = new Router($this->getRoutes());
        $handler = $routes->route([
            'method' => $method,
            'uri' => $uri
        ]);
        $this->assertInstanceOf(GenericHandler::class, $handler);
        $this->assertSame($handler->vars, $vars);
    }

    /**
     * @dataProvider getRequestPaths
     */
    public function testPsr7(string $method, string $uri, array $vars)
    {
        $routes = new Router($this->getRoutes());
        $request = new Request($method, $uri);
        $handler = $routes->route($request);
        $this->assertInstanceOf(GenericHandler::class, $handler);
        $this->assertSame($handler->vars, $vars);
    }
    /**
     * @dataProvider getRequestPaths
     */
    public function testSuperGlobals(string $method, string $uri, array $vars)
    {
        $routes = new Router($this->getRoutes());
        $_SERVER['REQUEST_METHOD'] = $method;
        $_SERVER['REQUEST_URI'] = $uri;
        $handler = $routes->route();
        $this->assertInstanceOf(GenericHandler::class, $handler);
        $this->assertSame($handler->vars, $vars);
    }
}
