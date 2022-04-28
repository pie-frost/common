<?php
declare(strict_types=1);
namespace PIEFrost\Common;

use ParagonIE\CipherSweet\CipherSweet;
use ParagonIE\CipherSweet\EncryptedRow;
use ParagonIE\EasyDB\EasyDB;

abstract class Model
{
    public function __construct(protected EasyDB $db, protected CipherSweet $engine) {}
    abstract public function cipher(): EncryptedRow;
    abstract public function tableName(): string;
}
