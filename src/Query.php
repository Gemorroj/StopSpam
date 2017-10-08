<?php
namespace StopSpam;


class Query
{
    private $query = [];

    public function addIp($ip)
    {
        $this->query['ip'][] = $ip;
        return $this;
    }

    public function addUsername($username)
    {
        $this->query['username'][] = $username;
        return $this;
    }

    public function addEmail($email)
    {
        $this->query['email'][] = $email;
        return $this;
    }

    public function build(Options $options)
    {
        $query = \http_build_query(
            $this->query,
            null,
            '&',
            \PHP_QUERY_RFC3986
        );

        if ($options->isAllowTor()) {
            $query .= '&notorexit';
        }

        $query .= '&json';
        $query .= '&unix';

        return $query;
    }
}
