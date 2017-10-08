<?php
namespace StopSpam;

use Psr\Http\Message\ResponseInterface;
use StopSpam\Exception\RequestException;

class Response
{
    private $data;

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


    public function getSingleIp()
    {
        $value = \current($this->data['ip']);
        if (false === $value) {
            return false;
        }

        \next($this->data['ip']);
        return new Item($value);
    }

    public function getSingleUsername()
    {
        $value = \current($this->data['username']);
        if (false === $value) {
            return false;
        }

        \next($this->data['username']);
        return new Item($value);
    }

    public function getSingleEmail()
    {
        $value = \current($this->data['email']);
        if (false === $value) {
            return false;
        }

        \next($this->data['email']);
        return new Item($value);
    }

    public function getIp()
    {
        $out = [];
        foreach ($this->data['ip'] as $item) {
            $out[] = new Item($item);
        }
        return $out;
    }

    public function getUsername()
    {
        $out = [];
        foreach ($this->data['username'] as $item) {
            $out[] = new Item($item);
        }
        return $out;
    }

    public function getEmail()
    {
        $out = [];
        foreach ($this->data['email'] as $item) {
            $out[] = new Item($item);
        }
        return $out;
    }
}
