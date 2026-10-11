<?php

declare(strict_types=1);

namespace StopSpam;

use StopSpam\Exception\RequestException;
use Symfony\Contracts\HttpClient\ResponseInterface;

class Response
{
    private array $data;

    /**
     * Response constructor.
     *
     * @throws RequestException
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     */
    public function __construct(ResponseInterface $response)
    {
        $this->data = $response->toArray();
        $success = $this->data['success'] ?? null;
        if (1 !== $success) {
            $error = $this->data['error'] ?? 'unknown error';

            throw new RequestException('Error response: '.$error);
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function getData(): array
    {
        return $this->data;
    }

    public function getSingleIp(): ?Item
    {
        return $this->getIp()[0] ?? null;
    }

    public function getSingleUsername(): ?Item
    {
        return $this->getUsername()[0] ?? null;
    }

    public function getSingleEmail(): ?Item
    {
        return $this->getEmail()[0] ?? null;
    }

    /**
     * @return list<Item>
     */
    public function getIp(): array
    {
        if (!isset($this->data['ip'])) {
            return [];
        }

        $out = [];
        foreach ($this->data['ip'] as $item) {
            $out[] = new Item($item);
        }

        return $out;
    }

    /**
     * @return list<Item>
     */
    public function getUsername(): array
    {
        if (!isset($this->data['username'])) {
            return [];
        }

        $out = [];
        foreach ($this->data['username'] as $item) {
            $out[] = new Item($item);
        }

        return $out;
    }

    /**
     * @return list<Item>
     */
    public function getEmail(): array
    {
        if (!isset($this->data['email'])) {
            return [];
        }

        $out = [];
        foreach ($this->data['email'] as $item) {
            $out[] = new Item($item);
        }

        return $out;
    }
}
