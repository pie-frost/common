<?php
declare(strict_types=1);
namespace PIEFrost\Common\Traits;

use ParagonIE\EasyDB\EasyDB;
use PIEFrost\Common\Exceptions\DependencyException;
use PIEFrost\Common\Model;
use PIEFrost\Common\RuntimeState;
use Twig\Error\{
    LoaderError,
    RuntimeError,
    SyntaxError
};
use PIEFrost\Common\Utilities;
use PIEFrost\Common\ValueObjects\Redirect;
use Psr\Http\Message\ResponseInterface;
use ReflectionException;

/**
 * Syntactic Sugar!
 *
 * @property RuntimeState $state
 */
trait SugarTrait
{
    /**
     * @return EasyDB
     *
     * @throws DependencyException
     */
    public function db(): EasyDB
    {
        return $this->state->getEasyDB();
    }

    /**
     * @param array $data
     * @param array $headers
     * @return ResponseInterface
     */
    public function json(
        array $data,
        array $headers = [],
        int $status = 200
    ): ResponseInterface {
        return Utilities::jsonResponse($data, $headers, $status);
    }

    /**
     * Load a Model class for handling encrypted data.
     *
     * @param string $name
     * @param string|null $ns
     * @return Model
     * @throws DependencyException
     * @throws ReflectionException
     */
    public function model(string $name, ?string $ns = null): Model
    {
        $db = $this->state->getEasyDB();
        $engine = $this->state->getEncryptionEngine();

        if (!$ns) {
            // On level up from the caller, then into the Model sub-namespace
            $ns = preg_replace(
                Utilities::NAMESPACE_SUFFIX_REGEX,
                '\\Model',
                Utilities::getCallerNamespace(1)
            );
        }
        // Trim all
        $ns = trim($ns, '\\');

        $trials = [
            $ns . '\\' . $name,
            $ns . 's\\' . $name,
            preg_replace(Utilities::NAMESPACE_SUFFIX_REGEX, '', $ns) . '\\' .$name,
            preg_replace(Utilities::NAMESPACE_SUFFIX_REGEX, '', $ns) . 's\\' .$name,
            $ns . '\\Model\\' . $name,
            $ns . '\\Models\\' . $name,
        ];
        foreach ($trials as $trial) {
            if (class_exists($trial)) {
                if (!is_subclass_of($trial, Model::class, true)) {
                    continue;
                }
                /** @psalm-suppress UnsafeInstantiation */
                return new $trial($db, $engine);
            }
        }
        throw new DependencyException("Could not load model: {$name}");
    }

    public function respond(
        Redirect|array|string $generic,
        array $headers = [],
        int $status = 200
    ): ResponseInterface {
        if ($generic instanceof Redirect) {
            return $generic->respond();
        }
        if (is_array($generic)) {
            return Utilities::jsonResponse($generic, $headers, $status);
        }
        return Utilities::htmlResponse($generic, $headers, $status);
    }

    /**
     * @param string $name
     * @param array $context
     * @return string
     *
     * @throws DependencyException
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function twig(string $name, array $context = []): string
    {
        return $this->state->getTwig()->render($name, $context);
    }
}
