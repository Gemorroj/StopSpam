# Wrapper for API [stopforumspam.com](https://www.stopforumspam.com/usage)

[![Build Status](https://secure.travis-ci.org/Gemorroj/StopSpam.png?branch=master)](https://travis-ci.org/Gemorroj/StopSpam)


### Requirements:

- PHP >= 7.3


### Installation:
```bash
composer require gemorroj/stop-spam
```


### Example check IP:

```php
<?php
use StopSpam\Request;
use StopSpam\Query;

$query = new Query();
$query->addIp('1.2.3.4');

$request = new Request();
$response = $request->send($query);
$item = $response->getFlowingIp();
var_dump($item->isAppears()); // bool (true)
```
