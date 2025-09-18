# Utilities

The `Utilities` class provides a set of miscellaneous static utility functions.

## Public Methods

### `jsonResponse(array|object $data, array $headers = [], int $statusCode = 200): Response`

Creates a PSR-7 `Response` object with a JSON body.

* `$data`: The data to be encoded as JSON.
* `$headers`: An array of additional headers.
* `$statusCode`: The HTTP status code.

### `htmlResponse(string $document, array $headers = [], int $statusCode = 200): Response`

Creates a PSR-7 `Response` object with an HTML body.

* `$document`: The HTML document.
* `$headers`: An array of additional headers.
* `$statusCode`: The HTTP status code.

### `getCallerNamespace(int $skip = 0): string`

Gets the namespace of the calling function.

* `$skip`: The number of additional stack frames to skip.

### `backtraceNamespace(): array`

Provides a backtrace with namespace information.
