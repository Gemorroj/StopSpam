<?php

declare(strict_types=1);

namespace StopSpam\Tests;

use PHPUnit\Framework\TestCase;
use StopSpam\Options;
use StopSpam\Query;

class QueryTest extends TestCase
{
    public function testBuildDefaultOptions(): void
    {
        $query = new Query();
        $query->addIp('1.2.3.4');

        $result = $query->build(new Options());

        self::assertSame(['1.2.3.4'], $result['ip']);
        self::assertArrayHasKey('badtorexit', $result);
        self::assertArrayNotHasKey('notorexit', $result);
        self::assertArrayNotHasKey('expire', $result);
        self::assertSame('', $result['json']);
        self::assertSame('', $result['unix']);
    }

    public function testBuildAllowTor(): void
    {
        $query = new Query();
        $query->addIp('1.2.3.4');

        $result = $query->build((new Options())->setAllowTor(true));

        self::assertArrayHasKey('notorexit', $result);
        self::assertArrayNotHasKey('badtorexit', $result);
    }

    public function testBuildExpire(): void
    {
        $query = new Query();
        $query->addIp('1.2.3.4');

        $result = $query->build((new Options())->setExpire(30));

        self::assertSame('30', $result['expire']);
    }
}
