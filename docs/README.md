# PIE-Frost/Common Documentation

This library provides a set of reusable components for building web applications in PHP without depending on any
specific application framework.

This documentation is split into several pages, each covering a major component of the library:

* [Cache](./Cache) - Caching services.
* [Interfaces](./Interfaces) - Interfaces used throughout the library.
* [Response](./Response) - HTTP response decorator classes.
* [Traits](./Traits) - Traits that add functionality to classes.
* [Router](./Router.md) - Handles HTTP requests, calls out to Handlers.
* [ValueObjects](./ValueObjects) - Value objects.
* [BaseHandler](./BaseHandler.md) - Base class for implementing Handler classes.
* [Exceptions](./Exceptions.md) - Custom exception classes.
* [Model](./Model.md) - Interacts with the database, represents a single SQL table.
* [RuntimeState](./RuntimeState.md) - Wraps the global configuration for the current deployment.
* [Utilities](./Utilities.md) - Miscellaneous utility functions.

## Extensibility

Applications that consume this library may extend these abstractions. For example, a consuming application wanting an
ORM-like developer experience may implement "Entity" classes, which wrap a single row for each table (which, as
mentioned before, are represented by a child of the `Model` class).
