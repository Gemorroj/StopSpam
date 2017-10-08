<?php
namespace StopSpam\Tests;

use StopSpam\Request;
use StopSpam\Query;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $query = new Query();
        $query->addIp('1.2.3.4');
        $query->addIp('1.2.3.5');

        $request = new Request();
        $response = $request->send($query);

        var_dump($response->getSingleIp());
        var_dump($response->getSingleIp());
        var_dump($response->getSingleIp());
    }
}
