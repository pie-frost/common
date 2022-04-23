<?php
declare(strict_types=1);
namespace PIEFrost\Common\Traits;

use ParagonIE\EasyDB\EasyDB;
use PIEFrost\Common\Exceptions\DependencyException;
use PIEFrost\Common\RuntimeState;
use Twig\Error\{
    LoaderError,
    RuntimeError,
    SyntaxError
};
use PIEFrost\Common\Utilities;
use PIEFrost\Common\ValueObjects\Redirect;
use Psr\Http\Message\ResponseInterface;

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
        array $headers = []
    ): ResponseInterface {
        return Utilities::jsonResponse($data, $headers);
    }

    public function respond(
        Redirect|array|string $generic,
        array $headers = []
    ): ResponseInterface {
        if ($generic instanceof Redirect) {
            return $generic->respond();
        }
        if (is_array($generic)) {
            return Utilities::jsonResponse($generic, $headers);
        }
        return Utilities::htmlResponse($generic, $headers);
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
