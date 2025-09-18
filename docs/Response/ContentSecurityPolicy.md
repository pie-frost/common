# ContentSecurityPolicy

The `ContentSecurityPolicy` class is a response decorator that adds a Content-Security-Policy header to the response.
It uses [`paragonie/csp-builder`](https://github.com/paragonie/csp-builder).

## Public Methods

### `__construct(CSPBuilder $builder)`

The constructor for the `ContentSecurityPolicy` class.

* `$builder`: A `CSPBuilder` object.

### `getBuilder(): CSPBuilder`

Returns the `CSPBuilder` object.

### `decorate(ResponseInterface $response): ResponseInterface`

Adds the Content-Security-Policy header to the given response.

* `$response`: The response to decorate.
