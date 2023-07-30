<?php
declare(strict_types=1);
namespace PIEFrost\Common;

use ParagonIE\CipherSweet\CipherSweet;
use ParagonIE\CipherSweet\EncryptedRow;
use ParagonIE\EasyDB\EasyDB;
use PIEFrost\Common\Traits\SugarTrait;

abstract class Model
{
    use SugarTrait;
    protected EasyDB $db;
    protected CipherSweet $engine;

    public function __construct(protected RuntimeState $state)
    {
        $this->db = $this->state->getEasyDB();
        $this->engine = $this->state->getEncryptionEngine();
    }

    abstract public function cipher(): EncryptedRow;
    abstract public function tableName(): string;
}
