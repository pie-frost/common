# Exceptions

This component provides a set of custom exception classes.

## `CommonException`

This is a generic exception class that can be used for any purpose. It extends `\Exception`.

## `DependencyException`

This exception is thrown when a dependency is not injected into the `RuntimeState`. It extends `CommonException`.

## `RequestException`

Thrown by classes that implement [ServerRequestDecoratorInterface](Interfaces/ServerRequestDecoratorInterface.md) to
prevent the request from being invoked. May include an optional Redirect object (call `getRedirect()` and check if 
non-null). If it does, redirect to that URL instead.

## `RouteException`

This exception is thrown by the `Router` when it encounters an error. It extends `CommonException`.

## `SecurityException`

This exception is thrown when a security-related error occurs. It extends `CommonException`.
