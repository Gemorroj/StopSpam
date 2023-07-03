# Wrapper for API [stopforumspam.com](https://www.stopforumspam.com/usage)

[![Continuous Integration](https://github.com/Gemorroj/StopSpam/workflows/Continuous%20Integration/badge.svg?branch=master)](https://github.com/Gemorroj/StopSpam/actions?query=workflow%3A%22Continuous+Integration%22)


### Requirements:

- PHP >= 8.0.2


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
