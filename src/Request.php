<?php
namespace StopSpam;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException as GuzzleRequestException;
use StopSpam\Exception\RequestException;

class Request
{
    private $options;
    private $client;


    public function __construct(Options $options = null)
    {
        $this->options = $options ?: new Options();
        $this->client = new Client([
            'headers' => ['User-Agent' => 'StopSpam client [https://github.com/Gemorroj/stop-spam]']
        ]);
    }


    public function send(Query $query)
    {
        $response = $this->client->request('GET', Uri::fromParts([
            'scheme' => $this->options->getScheme(),
            'host' => 'api.stopforumspam.org',
            'path' => '/api',
            'query' => $query->build($this->options),
        ]));

        if (200 !== $response->getStatusCode()) {
            throw new RequestException('Invalid HTTP response code');
        }

        return new Response($response);
    }


    public function sendAsync(Query $query, callable $fn)
    {
        $promise = $this->client->requestAsync('GET', Uri::fromParts([
            'scheme' => $this->options->getScheme(),
            'host' => 'api.stopforumspam.org',
            'path' => '/api',
            'query' => $query->build($this->options),
        ]));

        $promise->then(
            function (ResponseInterface $response) use ($fn) {
                if (200 !== $response->getStatusCode()) {
                    throw new RequestException('Invalid HTTP response code');
                }

                $fn(new Response($response));
            },
            function (GuzzleRequestException $e) {
                throw new RequestException('Unable send request', 0, $e);
            }
        )->wait(true);
    }
}
