<?php
declare(strict_types=1);
namespace PIEFrost\Common;

use FastRoute\Dispatcher;
use PIEFrost\Common\Exceptions\RouteException;
use PIEFrost\Common\Interfaces\HandlerInterface;
use Psr\Http\Message\RequestInterface;

class Router
{
    protected Dispatcher $dispatcher;
    protected ?RuntimeState $state = null;

    public function __construct(Dispatcher $dispatcher, ?RuntimeState $state = null)
    {
        $this->dispatcher = $dispatcher;
        $this->state = $state;
    }

    public function injectState(RuntimeState $state): self
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @param RequestInterface|array|null $request
     * @return HandlerInterface
     *
     * @throws RouteException
     */
    public function route(RequestInterface|array|null $request = null): HandlerInterface
    {
        if ($request instanceof RequestInterface) {
            return $this->routePsr7($request);
        }
        if (is_array($request)) {
            return $this->routeArray($request);
        }
        return $this->routeSuperGlobal();
    }

    /**
     * @param array $request
     * @return HandlerInterface
     */
    protected function routeArray(array $request): HandlerInterface
    {
        if (!isset($request['method'])) {
            throw new RouteException("No method provided");
        }
        if (!isset($request['uri'])) {
            throw new RouteException("No URI provided");
        }
        return $this->dispatch($request['method'], $request['uri']);
    }

    /**
     * @param RequestInterface $request
     * @return HandlerInterface
     *
     * @throws RouteException
     */
    protected function routePsr7(RequestInterface $request): HandlerInterface
    {
        return $this->dispatch(
            $request->getMethod(),
            $request->getUri()->getPath()
        );
    }

    /**
     * @return HandlerInterface
     * @throws RouteException
     */
    protected function routeSuperGlobal(): HandlerInterface
    {
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];
        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);
        return $this->dispatch($httpMethod, $uri);
    }

    /**
     * @param string $httpMethod
     * @param string $uri
     * @return HandlerInterface
     *
     * @throws RouteException
     */
    protected function dispatch(string $httpMethod, string $uri): HandlerInterface
    {
        $routeInfo = $this->dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case Dispatcher::FOUND:
                /** @var class-string $handler */
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                if (!class_exists($handler)) {
                    throw new RouteException("Unknown class: {$handler}");
                }
                /** @var HandlerInterface $object */
                $object = new $handler;
                if (!is_null($this->state)) {
                    $object->injectState($this->state);
                }
                return $object->setVars($vars);
            default:
                throw new RouteException("Bad HTTP Request");
        }
    }
}
