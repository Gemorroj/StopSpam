<?php
namespace StopSpam;

use Psr\Http\Message\ResponseInterface;
use StopSpam\Exception\RequestException;

class Response
{
    /**
     * @var array
     */
    private $data;

    /**
     * Response constructor.
     * @param ResponseInterface $response
     * @throws RequestException
     */
    public function __construct(ResponseInterface $response)
    {
        $this->data = \GuzzleHttp\json_decode((string)$response->getBody(), true);
        if (1 !== $this->data['success']) {
            throw new RequestException('Error response: ' . $this->data['error']);
        }
    }


    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }


    /**
     * @return null|Item
     */
    public function getFlowingIp()
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

    /**
     * @return null|Item
     */
    public function getFlowingUsername()
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

    /**
     * @return null|Item
     */
    public function getFlowingEmail()
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
     * @return array
     */
    public function getIp()
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
     * @return array
     */
    public function getUsername()
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
     * @return array
     */
    public function getEmail()
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
