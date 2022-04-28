<?php
declare(strict_types=1);
namespace PIEFrost\Common\Tests;

use PHPUnit\Framework\TestCase;
use PIEFrost\Common\Utilities;

class UtilitiesTest extends TestCase
{
    public function testGetCallerNamespace()
    {
        $this->assertSame(
            'PIEFrost\\Common\\Tests',
            Utilities::getCallerNamespace()
        );
    }
}
