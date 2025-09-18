# RuntimeState

The `RuntimeState` class is a container for the global configuration of the application. It provides a way to inject
dependencies into other components.

Extensibility is encouraged; this class will not be declared `final`, but yours **MUST** be if you extend the class.

## Public Methods

### `getEncryptionEngine(): CipherSweet`

Returns the `CipherSweet` encryption engine.

### `getEasyDB(): EasyDB`

Returns the `EasyDB` database connection.

### `getRouter(): Router`

Returns the `Router` object.

### `getTwig(): Environment`

Returns the `Twig` environment.

### `getModelCache(): ModelCache`

Returns the `ModelCache` object.

### `hasModelCache(): bool`

Returns `true` if a `ModelCache` object has been injected, `false` otherwise.

### `withModelCache(ModelCache $modelCache): self`

Injects a `ModelCache` object.

### `withEasyDB(EasyDB $db): self`

Injects an `EasyDB` object.

### `withEncryptionEngine(CipherSweet $engine): self`

Injects a `CipherSweet` object.

### `withRouter(Router $router): self`

Injects a `Router` object.

### `withTwig(Environment $twig): self`

Injects a `Twig` environment.
