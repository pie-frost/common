# Redirect

The `Redirect` class is a value object that represents an HTTP redirect.

### `__construct(UriInterface|string $url, string $message = '', int $status = 301)`

The constructor for the `Redirect` class.

* `$url`: The URL to redirect to.
* `$message`: An optional message to include in the response body.
* `$status`: The HTTP status code.

### `respond(): ResponseInterface`

Returns a PSR-7 `Response` object that represents the redirect.
