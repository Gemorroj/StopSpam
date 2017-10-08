<?php
namespace StopSpam\Tests;

use StopSpam\Request;
use StopSpam\Query;
use StopSpam\Response;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    public function testSync()
    {
        $query = new Query();
        $query->addIp('1.2.3.4');
        $query->addIp('1.2.3.5');

        $request = new Request();
        $response = $request->send($query);

        $this->checkResponse(
            $response->getFlowingIp(),
            $response->getFlowingIp(),
            $response->getFlowingIp()
        );
    }

    public function testAsync()
    {
        $query = new Query();
        $query->addIp('1.2.3.4');
        $query->addIp('1.2.3.5');

        $request = new Request();
        $request->sendAsync($query, function (Response $response) {
            $this->checkResponse(
                $response->getFlowingIp(),
                $response->getFlowingIp(),
                $response->getFlowingIp()
            );
        });
    }


    private function checkResponse($firstItem, $secondItem, $thirdItem)
    {
        $this->assertEquals('1.2.3.4', $firstItem->getValue());
        $this->assertTrue($firstItem->isAppears());
        $this->assertEquals('au', $firstItem->getData()['country']);

        $this->assertEquals('1.2.3.5', $secondItem->getValue());
        $this->assertFalse($secondItem->isAppears());

        $this->assertFalse($thirdItem);
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
