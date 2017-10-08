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

        var_dump($response->getFlowingIp());
        var_dump($response->getFlowingIp());
        var_dump($response->getFlowingIp());
    }

    public function testAsync()
    {
        $query = new Query();
        $query->addIp('1.2.3.4');
        $query->addIp('1.2.3.5');

        $request = new Request();
        $request->sendAsync($query, function (Response $response) {
            var_dump($response->getFlowingIp());
            var_dump($response->getFlowingIp());
            var_dump($response->getFlowingIp());
        });
    }
}
