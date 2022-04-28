<?php
declare(strict_types=1);
namespace PIEFrost\Common;

use GuzzleHttp\Psr7\Response;
use ReflectionException;
use ReflectionMethod;
use ReflectionFunction;

class Utilities
{
    public const NAMESPACE_SUFFIX_REGEX = '#\\\\[^\\\\]+?$#';

    public static function jsonResponse(
        array|object $data,
        array $headers = [],
        int $statusCode = 200
    ): Response {
        $headers['Content-Type'] = 'application/json';
        return new Response(
            $statusCode,
            $headers,
            json_encode($data, JSON_PRETTY_PRINT)
        );
    }

    public static function htmlResponse(
        string $document,
        array $headers = [],
        int $statusCode = 200
    ): Response {
        return new Response(
            $statusCode,
            $headers,
            $document
        );
    }

    /**
     * @throws ReflectionException
     */
    public static function getCallerNamespace(int $skip = 0): string
    {
        $traced = self::backtraceNamespace();
        // We need to discard the first two calls to get to the caller:
        array_shift($traced);
        array_shift($traced);

        // We discard additional values if asked:
        for ($i = 0; $i < $skip; ++$i) {
            array_shift($traced);
        }

        /** @var array{function: string, namespace: string} $found */
        $found = array_shift($traced);
        return $found['namespace'];
    }

    /**
     * @throws ReflectionException
     */
    public static function backtraceNamespace(): array
    {
        $trace = array();
        $functions = array_map(
            function ($v) {
                return [$v['function'], $v['class'] ?? ''];
            },
            debug_backtrace()
        );
        foreach ($functions as $found) {
            /**
             * @var string $func
             * @var string $class
             */
            [$func, $class] = $found;
            if (empty($class)) {
                /** @psalm-suppress ArgumentTypeCoercion */
                $f = new ReflectionFunction($func);
                $trace[] = array(
                    'function' => $func,
                    'class' => $class,
                    'namespace' =>  $f->getNamespaceName()
                );
            } else {
                $pieces = explode('\\', $class);
                $className = array_pop($pieces);
                $trace[] = array(
                    'function' => $func,
                    'class' => $className,
                    'namespace' =>  implode('\\', $pieces)
                );
            }
        }
        return $trace;
    }
}
