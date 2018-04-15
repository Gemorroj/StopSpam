<?php
namespace StopSpam;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException as GuzzleRequestException;
use StopSpam\Exception\RequestException;

class Request
{
    /**
     * @var Options
     */
    private $options;
    /**
     * @var Client
     */
    private $client;


    /**
     * Request constructor.
     * @param Options|null $options
     */
    public function __construct(Options $options = null)
    {
        $this->options = $options ?: new Options();
        $this->client = new Client([
            'headers' => ['User-Agent' => 'StopSpam client [https://github.com/Gemorroj/StopSpam]']
        ]);
    }


    /**
     * @param Query $query
     * @return Response
     * @throws RequestException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
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


    /**
     * @param Query $query
     * @param callable $fn
     */
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
