# ResponseDecoratorInterface

This interface can be implemented by classes that decorate a PSR-7 `ResponseInterface`.

This is essentially a response-only middleware.

## Interface Methods

### `decorate(ResponseInterface $response): ResponseInterface`

This method takes a `ResponseInterface` and returns a modified `ResponseInterface`.
