# Wrapper for API stopforumspam.org

[![Build Status](https://secure.travis-ci.org/Gemorroj/StopSpam.png?branch=master)](https://travis-ci.org/Gemorroj/StopSpam)


### Requirements:

- PHP >= 5.6
- ext-curl


### Installation:

- add to composer.json:

```json
{
    "require": {
        "gemorroj/stop-spam": "dev-master"
    }
}
```
- install:

```bash
$ php composer.phar update gemorroj/stop-spam
```


### Example:

```php
use StopSpam\Request;
use StopSpam\Query;

$query = new Query();
$query->addIp('1.2.3.4');

$request = new Request();
$response = $request->send($query);
$item = $response->getFlowingIp();
var_dump($item->isAppears()); // bool (true)
```

##### Async example
```php
use StopSpam\Request;
use StopSpam\Query;
use StopSpam\Response;

$query = new Query();
$query->addIp('1.2.3.4');

$request = new Request();
$request->sendAsync($query, function (Response $response) {
    $item = $response->getFlowingIp();
    var_dump($item->isAppears()); // bool (true)
});
```
