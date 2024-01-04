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
        if (1 !== $this->data['success']) {
            throw new RequestException('Error response: '.$this->data['error']);
        }
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getFlowingIp(): ?Item
    {
        if (!isset($this->data['ip'])) {
            return null;
        }

        $value = \current($this->data['ip']);
        if (false === $value) {
            return null;
        }

        \next($this->data['ip']);

        return new Item($value);
    }

    public function getFlowingUsername(): ?Item
    {
        if (!isset($this->data['username'])) {
            return null;
        }

        $value = \current($this->data['username']);
        if (false === $value) {
            return null;
        }

        \next($this->data['username']);

        return new Item($value);
    }

    public function getFlowingEmail(): ?Item
    {
        if (!isset($this->data['email'])) {
            return null;
        }

        $value = \current($this->data['email']);
        if (false === $value) {
            return null;
        }

        \next($this->data['email']);

        return new Item($value);
    }

    /**
     * @return Item[]
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
     * @return Item[]
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
     * @return Item[]
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
