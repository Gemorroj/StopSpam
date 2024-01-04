<?php

declare(strict_types=1);

namespace StopSpam;

use StopSpam\Exception\RequestException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Request
{
    private Options $options;
    private HttpClientInterface $httpClient;
    protected string $apiEndpoint = 'https://api.stopforumspam.org/api';

    public function __construct(HttpClientInterface $httpClient = null, Options $options = null)
    {
        $this->options = $options ?: new Options();
        $this->httpClient = $httpClient ?: HttpClient::create([
            'headers' => [
                'User-Agent' => 'StopSpam client [https://github.com/Gemorroj/StopSpam]',
            ],
        ]);
    }

    /**
     * @throws RequestException
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     */
    public function send(Query $query): Response
    {
        $response = $this->httpClient->request('GET', $this->apiEndpoint, [
            'query' => $query->build($this->options),
        ]);

        return new Response($response);
    }
}
