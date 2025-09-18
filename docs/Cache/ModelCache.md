# ModelCache

The `ModelCache` class provides an in-memory cache for `Model` objects.
This can be useful to avoid creating multiple instances of the same model.

## Public Methods

### `getModel(string $model, string $namespace): ?Model`

Gets a `Model` object from the cache.

* `$model`: The name of the model class.
* `$namespace`: The namespace of the model class.

Returns the `Model` object if it exists in the cache, or `null` otherwise.

### `storeModel(string $model, string $namespace, Model $object): void`

Stores a `Model` object in the cache.

* `$model`: The name of the model class.
* `$namespace`: The namespace of the model class.
* `$object`: The `Model` object to store.
