# Model

The `Model` class is an abstract class that represents a single SQL table. It provides a base for creating model classes
that interact with the database.

## Public Methods

### `__construct(RuntimeState $state)`

The constructor for the `Model` class.

* `$state`: A `RuntimeState` object.

## Abstract Methods

### `cipher(): EncryptedRow`

This method must be implemented by child classes. It should return a `ParagonIE\CipherSweet\EncryptedRow` object that
defines the encrypted fields for the table.

### `tableName(): string`

This method must be implemented by child classes. It should return the name of the SQL table that the model represents.
