# Router

The `Router` class is responsible for handling HTTP requests and dispatching them to the appropriate handler.
It is designed to be used with [NikiC\FastRoute](https://github.com/nikic/FastRoute).

## Public Methods

### `__construct(Dispatcher $dispatcher, ?RuntimeState $state = null)`

The constructor for the `Router` class.

* `$dispatcher`: An instance of `FastRoute\Dispatcher`.
* `$state`: An optional `RuntimeState` object.

### `injectState(RuntimeState $state): self`

Injects a `RuntimeState` object into the router. This is useful if you need to provide the state to the router after it has been constructed.

* `$state`: The `RuntimeState` object to inject.

### `route(RequestInterface|array|null $request = null): HandlerInterface`

This is the main method of the `Router`. It takes a request object or array (and falls back to use the $_SERVER 
superglobals) and returns an appropriate `HandlerInterface` object.

* `$request`: A PSR-7 `RequestInterface` object, an array, or `null`. If `null`, the `$_SERVER` superglobal
  will be used.

The array format for `$request` should be:

```php
[
    'method' => 'GET',
    'uri' => '/path/to/resource'
]
```

## Example Usage of the Router class

Create a configuration script (e.g. `config/routes.php`), like so:

```php
<?php
declare(strict_types=1);
namespace YourOrg\ApplicationName\Config;

use FastRoute\RouteCollector;
use YourOrg\ApplicationName\Handlers\DefaultHandler;
use PIEFrost\Common\Router;
use function FastRoute\simpleDispatcher;

return new Router(simpleDispatcher(function (RouteCollector $r) {
    // Add your routes here
    $r->addRoute(['GET', 'POST'], '/', DefaultHandler::class);
    $r->addRoute(['GET', 'POST'], '', DefaultHandler::class);
}));
```

Then to load this object, inject it like so:

```php
<?php
$state = (new \PIEFrost\Common\RuntimeState())
    /* other dependency injections here */
    ->withRouter(require_once YOURAPP_ROOT . '/config/routes.php');
```

(See [RuntimeState](RuntimeState.md) for more information.)

Finally, you can serve it however you'd like:

```php
<?php
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

$router = $state->getRouter();
$router->injectState($state);
try {
    // Get the handler
    $handler = $router->route($request);
    
    // Now serve the result:
    (new SapiEmitter())->emit(
        $handler->decorate(
            $handler->init()->handle($request)
        )
    );
} catch (Throwable $ex) {
    header("Content-Type: text/plain");
    header('HTTP/1.1 500 Internal Service Error');
    if (defined('YOURAPP_DEBUG')) {
        echo $ex->getMessage(), PHP_EOL;
        echo $ex->getTraceAsString();
    }
}
```
