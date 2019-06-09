<?php

namespace StopSpam;

class Query
{
    private $query = [];

    /**
     * @param string $ip
     *
     * @return $this
     */
    public function addIp(string $ip): self
    {
        $this->query['ip'][] = $ip;

        return $this;
    }

    /**
     * @param string $username
     *
     * @return $this
     */
    public function addUsername(string $username): self
    {
        $this->query['username'][] = $username;

        return $this;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function addEmail(string $email): self
    {
        $this->query['email'][] = $email;

        return $this;
    }

    /**
     * @param Options $options
     *
     * @return array
     */
    public function build(Options $options): array
    {
        $result = $this->query;
        if ($options->isAllowTor()) {
            $result['notorexit'] = '';
        }

        $result['json'] = '';
        $result['unix'] = '';

        return $result;
    }
}
