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
        $query->addIp('1.2.3.4');
        $query->addIp('1.2.3.5');
        $query->addUsername('putin');
        $query->addEmail('test@test.test');

        $request = new Request();
        $response = $request->send($query);

        $this->checkIpResponse(
            $response->getFlowingIp(),
            $response->getFlowingIp(),
            $response->getFlowingIp()
        );

        $this->checkUsernameResponse($response->getFlowingUsername());
        $this->checkEmailResponse($response->getFlowingEmail());
    }

    private function checkIpResponse(?Item $firstItem, ?Item $secondItem, ?Item $thirdItem): void
    {
        $this->assertEquals('1.2.3.4', $firstItem->getValue());
        $this->assertTrue($firstItem->isAppears());
        $this->assertStringMatchesFormat('%s', $firstItem->getData()['country']);

        $this->assertEquals('1.2.3.5', $secondItem->getValue());
        $this->assertFalse($secondItem->isAppears());

        $this->assertNull($thirdItem);
    }

    private function checkUsernameResponse(?Item $item): void
    {
        $this->assertEquals('putin', $item->getValue());
        $this->assertFalse($item->isAppears());
    }

    private function checkEmailResponse(?Item $item): void
    {
        $this->assertEquals('test@test.test', $item->getValue());
        $this->assertFalse($item->isAppears());
    }

    /**
     * @expectedException \Symfony\Component\HttpClient\Exception\ServerException
     */
    public function testSendException(): void
    {
        $query = new Query();
        $query->addIp('fake ip');

        $request = new Request();
        $request->send($query);
    }
}
