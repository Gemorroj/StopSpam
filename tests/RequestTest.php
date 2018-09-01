<?php
namespace StopSpam\Tests;

use StopSpam\Item;
use StopSpam\Query;
use StopSpam\Request;
use StopSpam\Response;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    public function testSync()
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

    public function testAsync()
    {
        $query = new Query();
        $query->addIp('1.2.3.4');
        $query->addIp('1.2.3.5');

        $request = new Request();
        $request->sendAsync($query, function (Response $response) {
            $this->checkIpResponse(
                $response->getFlowingIp(),
                $response->getFlowingIp(),
                $response->getFlowingIp()
            );
        });
    }


    /**
     * @param Item|null $firstItem
     * @param Item|null $secondItem
     * @param Item|null $thirdItem
     */
    private function checkIpResponse($firstItem, $secondItem, $thirdItem)
    {
        $this->assertEquals('1.2.3.4', $firstItem->getValue());
        $this->assertTrue($firstItem->isAppears());
        $this->assertEquals('au', $firstItem->getData()['country']);

        $this->assertEquals('1.2.3.5', $secondItem->getValue());
        $this->assertFalse($secondItem->isAppears());

        $this->assertNull($thirdItem);
    }

    /**
     * @param Item|null $item
     */
    private function checkUsernameResponse($item)
    {
        $this->assertEquals('putin', $item->getValue());
        $this->assertFalse($item->isAppears());
    }

    /**
     * @param Item|null $item
     */
    private function checkEmailResponse($item)
    {
        $this->assertEquals('test@test.test', $item->getValue());
        $this->assertFalse($item->isAppears());
    }

    /**
     * @expectedException \StopSpam\Exception\RequestException
     */
    public function testAsyncException()
    {
        $query = new Query();
        $query->addIp('fake ip');

        $request = new Request();
        $request->sendAsync($query, function (Response $response) {
            //nothing
        });
    }
}
