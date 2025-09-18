# ServerRequestDecoratorInterface

This interface can be implemented by classes that decorate a PSR-7 `ServerRequestInterface`.

This is essentially a request-only middleware.

## Interface Methods

### `decorate(ServerRequestInterface $request): ServerRequestInterface`

This method takes a `ServerRequestInterface` and returns a modified `ServerRequestInterface`.
