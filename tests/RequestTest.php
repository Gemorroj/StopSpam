<?php

namespace StopSpam\Tests;

use PHPUnit\Framework\TestCase;
use StopSpam\Item;
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

        $firstItem = $response->getFlowingIp();
        $secondItem = $response->getFlowingIp();

        self::assertEquals('1.2.3.5', $firstItem->getValue());
        self::assertFalse($firstItem->isAppears());
        self::assertIsNumeric($firstItem->getFrequency());
        self::assertFalse($firstItem->isError());

        self::assertNull($secondItem);

        $this->checkUsernameResponse($response->getFlowingUsername());
        $this->checkEmailResponse($response->getFlowingEmail());
    }

    private function checkUsernameResponse(?Item $item): void
    {
        self::assertEquals('putin', $item->getValue());
        self::assertTrue($item->isAppears());
    }

    private function checkEmailResponse(?Item $item): void
    {
        self::assertEquals('test@test.test', $item->getValue());
        self::assertFalse($item->isAppears());
    }

    public function testSendInvalidIp(): void
    {
        $query = new Query();
        $query->addIp('fake ip');

        $request = new Request();
        $response = $request->send($query);

        $v = $response->getFlowingIp();

        self::assertTrue($v->isError());
        self::assertStringMatchesFormat('%s', $v->getError());
    }
}
