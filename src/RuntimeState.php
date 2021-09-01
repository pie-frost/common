<?php
declare(strict_types=1);
namespace PIEFrost\Common;

use ParagonIE\EasyDB\EasyDB;
use PIEFrost\Common\Exceptions\DependencyException;
use Twig\Environment;

class RuntimeState
{
    protected ?EasyDB $db = null;
    protected ?Environment $twig = null;

    public function getEasyDB(): EasyDB
    {
        if (is_null($this->db)) {
            throw new DependencyException("Database not injected");
        }
        return $this->db;
    }

    public function getTwig(): Environment
    {
        if (is_null($this->twig)) {
            throw new DependencyException("Twig not injected");
        }
        return $this->twig;
    }

    public function withEasyDB(EasyDB $db): self
    {
        $this->db = $db;
        return $this;
    }

    public function withTwig(Environment $twig): self
    {
        $this->twig = $twig;
        return $this;
    }
}
