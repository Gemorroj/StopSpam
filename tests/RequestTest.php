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
        $query->addIp('1.2.3.5');
        $query->addUsername('putin');
        $query->addEmail('test@test.test');

        $request = new Request();
        $response = $request->send($query);

        $firstIpItem = $response->getFlowingIp();
        $secondIpItem = $response->getFlowingIp();
        $firstUsernameItem = $response->getFlowingUsername();
        $firstEmailItem = $response->getFlowingEmail();

        self::assertEquals('1.2.3.5', $firstIpItem->getValue());
        self::assertFalse($firstIpItem->isAppears());
        self::assertIsNumeric($firstIpItem->getFrequency());
        self::assertFalse($firstIpItem->isError());

        self::assertNull($secondIpItem);

        self::assertEquals('putin', $firstUsernameItem->getValue());
        self::assertEquals('test@test.test', $firstEmailItem->getValue());
    }

    public function testSendInvalidIp(): void
    {
        $query = new Query();
        $query->addIp('fake ip');

        $request = new Request();
        $response = $request->send($query);

        $firstIpItem = $response->getFlowingIp();

        self::assertTrue($firstIpItem->isError());
        self::assertStringMatchesFormat('%s', $firstIpItem->getError());
    }
}
