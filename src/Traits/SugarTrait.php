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
