# BaseHandler

The `BaseHandler` is an abstract class that provides a base for creating handler classes.
It implements the [`HandlerInterface`](Interfaces/HandlerInterface.md) interface and provides some convenient methods.

Your actual `Handler` classes (which are not required to extend `BaseHandler`) must implement `__invoke()` in a manner
consistent with `HandlerInferface`.

## Public Methods

### `init(): static`

This method is called before the `handle()` method. You can override it to perform any initialization tasks.

### `decorate(ResponseInterface $response): ResponseInterface`

This method is called after the `handle()` method. You can override it to decorate the response before it is sent.
Response decorators implement the [ResponseDecoratorInterface](Interfaces/ResponseDecoratorInterface.md) interface. An
example is shipped with this library for adding Content-Security-Policy headers to HTTP responses.

### `injectState(RuntimeState $state): self`

Injects a `RuntimeState` object into the handler.

* `$state`: The `RuntimeState` object to inject.

### `setVars(array $vars): self`

Sets the variables that are extracted from the URL by the router.

* `$vars`: An array of variables.
