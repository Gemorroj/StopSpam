<?php

declare(strict_types=1);

namespace StopSpam\Tests;

use PHPUnit\Framework\TestCase;
use StopSpam\Exception\RequestException;
use StopSpam\Response;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class ResponseTest extends TestCase
{
    private static function createResponse(array $data): Response
    {
        $client = new MockHttpClient(new MockResponse((string) \json_encode($data)));

        return new Response($client->request('GET', 'https://example.com'));
    }

    public function testApiError(): void
    {
        $this->expectException(RequestException::class);
        $this->expectExceptionMessageIs('Error response: request not understood');

        self::createResponse(['success' => 0, 'error' => 'request not understood']);
    }

    public function testMissingError(): void
    {
        $this->expectException(RequestException::class);
        $this->expectExceptionMessageIs('Error response: unknown error');

        self::createResponse(['success' => 0]);
    }

    public function testMissingSuccess(): void
    {
        $this->expectException(RequestException::class);
        $this->expectExceptionMessageIs('Error response: unknown error');

        self::createResponse([]);
    }
}
