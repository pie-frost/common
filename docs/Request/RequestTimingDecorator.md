# RequestTimingDecorator

The `RequestTimingDecorator` class is a request decorator that adds a timestamp of when the request was preprocessed for
debugging.

## Public Methods

### `decorate(ServerRequestInterface $request): ServerRequestInterface`

Adds the current timestamp (with microsecond precision) as an attribute to the given request.

* `$request`: The request to decorate.
