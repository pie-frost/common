# HandlerInterface

This interface must be implemented by all handler classes. It extends
`Psr\Http\Server\RequestHandlerInterface` and defines the contract for a handler.

## Interface Methods

### `handle(ServerRequestInterface $request): ResponseInterface`

This method is the main entry point for a handler. It is inherited from `Psr\Http\Server\RequestHandlerInterface`.
It takes a PSR-7 `ServerRequestInterface` and returns a PSR-7 `ResponseInterface`.

### `decorate(ResponseInterface $response): ResponseInterface`

This method is called after the `handle()` method. You can override it to decorate the response before it is sent.

### `init(): static`

This method is called before the `handle()` method. You can override it to perform any initialization tasks.

### `injectState(RuntimeState $state): self`

Injects a `RuntimeState` object into the handler.

### `setVars(array $vars): self`

Sets the variables that are extracted from the URL by the router.
