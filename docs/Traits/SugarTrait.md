# SugarTrait

The `SugarTrait` provides a set of "syntactic sugar" methods that can be used in classes that have a `RuntimeState`
property. This trait is used by `BaseHandler` and `Model`.

## Trait Methods

### `db(): EasyDB`

Returns the `EasyDB` database connection from the `RuntimeState`.

### `json(array $data, array $headers = [], int $status = 200): ResponseInterface`

Creates a PSR-7 `Response` object with a JSON body.

### `model(string $name, ?string $ns = null): Model`

Loads a `Model` class. This method will automatically search for the model in a number of common locations.

### `respond(Redirect|array|string $generic, array $headers = [], int $status = 200): ResponseInterface`

A generic response helper. It can return a `Redirect` response, a JSON response, or an HTML response, depending on the
type of the first argument.

### `setTwigVar(string $name, mixed $value): static`

Sets a global variable in the `Twig` environment.

### `twig(string $name, array $context = []): string`

Renders a `Twig` template.
