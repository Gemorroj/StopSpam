<?php

declare(strict_types=1);

namespace StopSpam\Tests;

use PHPUnit\Framework\TestCase;
use StopSpam\Query;
use StopSpam\Request;

class RequestTest extends TestCase
{
    public function testSend(): void
    {
        $query = new Query();
        $query->addIp('192.0.2.1');
        $query->addUsername('putin');
        $query->addEmail('test@test.test');

        $request = new Request();
        $response = $request->send($query);

        $ipItems = $response->getIp();
        self::assertCount(1, $ipItems);

        $firstIpItem = $ipItems[0];
        self::assertSame('192.0.2.1', $firstIpItem->getValue());
        self::assertFalse($firstIpItem->isAppears());
        self::assertIsNumeric($firstIpItem->getFrequency());
        self::assertFalse($firstIpItem->isError());

        self::assertSame('putin', $response->getUsername()[0]->getValue());
        self::assertSame('test@test.test', $response->getEmail()[0]->getValue());

        self::assertSame('192.0.2.1', $response->getSingleIp()?->getValue());
        self::assertSame('putin', $response->getSingleUsername()?->getValue());
        self::assertSame('test@test.test', $response->getSingleEmail()?->getValue());
    }

    public function testSendInvalidIp(): void
    {
        $query = new Query();
        $query->addIp('fake ip');

        $request = new Request();
        $response = $request->send($query);

        $firstIpItem = $response->getIp()[0];

        self::assertTrue($firstIpItem->isError());
        self::assertStringMatchesFormat('%s', $firstIpItem->getError());
    }
}
