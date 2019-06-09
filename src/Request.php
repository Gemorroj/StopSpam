<?php

namespace StopSpam;

use StopSpam\Exception\RequestException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Request
{
    /**
     * @var Options
     */
    private $options;
    /**
     * @var HttpClient
     */
    private $httpClient;
    /**
     * @var string
     */
    protected $apiEndpoint = 'https://api.stopforumspam.org/api';

    /**
     * Request constructor.
     *
     * @param HttpClientInterface|null $httpClient
     * @param Options|null             $options
     */
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
     * @param Query $query
     *
     * @throws RequestException
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     *
     * @return Response
     */
    public function send(Query $query): Response
    {
        $response = $this->httpClient->request('GET', $this->apiEndpoint, [
            'query' => $query->build($this->options),
        ]);

        return new Response($response);
    }
}
