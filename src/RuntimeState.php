<?php
declare(strict_types=1);
namespace PIEFrost\Common;

use ParagonIE\CipherSweet\CipherSweet;
use ParagonIE\EasyDB\EasyDB;
use PIEFrost\Common\Exceptions\DependencyException;
use Twig\Environment;

class RuntimeState
{
    protected ?CipherSweet $encryptionEngine = null;
    protected ?EasyDB $db = null;
    protected ?Environment $twig = null;
    protected ?Router $router = null;

    /**
     * @throws DependencyException
     */
    public function getEncryptionEngine(): CipherSweet
    {
        if (is_null($this->encryptionEngine)) {
            throw new DependencyException("CipherSweet not injected");
        }
        return $this->encryptionEngine;
    }

    /**
     * @throws DependencyException
     */
    public function getEasyDB(): EasyDB
    {
        if (is_null($this->db)) {
            throw new DependencyException("Database not injected");
        }
        return $this->db;
    }

    /**
     * @throws DependencyException
     */
    public function getRouter(): Router
    {
        if (is_null($this->router)) {
            throw new DependencyException("Router not injected");
        }
        return $this->router;
    }

    /**
     * @throws DependencyException
     */
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

    public function withEncryptionEngine(CipherSweet $engine): self
    {
        $this->encryptionEngine = $engine;
        return $this;
    }
    
    public function withRouter(Router $router): self
    {
        $this->router = $router;
        return $this;
    }

    public function withTwig(Environment $twig): self
    {
        $this->twig = $twig;
        return $this;
    }
}
