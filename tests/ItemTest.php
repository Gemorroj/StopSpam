<?php

declare(strict_types=1);

namespace StopSpam\Tests;

use PHPUnit\Framework\TestCase;
use StopSpam\Item;

class ItemTest extends TestCase
{
    public function testGetters(): void
    {
        $item = new Item([
            'value' => 'test@test.test',
            'frequency' => 255,
            'appears' => 1,
            'confidence' => 99.95,
            'lastseen' => 1791703706,
            'torexit' => 1,
            'normalized' => 'normalized@test.test',
            'country' => 'gb',
            'asn' => 29550,
            'delegated' => 'us',
        ]);

        self::assertSame('test@test.test', $item->getValue());
        self::assertSame(255.0, $item->getFrequency());
        self::assertTrue($item->isAppears());
        self::assertSame(99.95, $item->getConfidence());
        self::assertSame(1791703706, $item->getLastSeen());
        self::assertTrue($item->isTorExit());
        self::assertSame('normalized@test.test', $item->getNormalized());
        self::assertSame('gb', $item->getCountry());
        self::assertSame(29550, $item->getAsn());
        self::assertSame('us', $item->getDelegated());
        self::assertFalse($item->isError());
        self::assertNull($item->getError());
    }

    public function testEmptyItem(): void
    {
        $item = new Item();

        self::assertSame([], $item->getData());
        self::assertNull($item->getValue());
        self::assertNull($item->getFrequency());
        self::assertFalse($item->isAppears());
        self::assertNull($item->getConfidence());
        self::assertNull($item->getLastSeen());
        self::assertFalse($item->isTorExit());
        self::assertNull($item->getNormalized());
        self::assertNull($item->getCountry());
        self::assertNull($item->getAsn());
        self::assertNull($item->getDelegated());
        self::assertFalse($item->isError());
        self::assertNull($item->getError());
    }
}
