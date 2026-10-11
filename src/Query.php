<?php

declare(strict_types=1);

namespace StopSpam;

class Query
{
    /**
     * @var array<string, list<string>>
     */
    private array $query = [];

    public function addIp(string $ip): self
    {
        $this->query['ip'][] = $ip;

        return $this;
    }

    public function addUsername(string $username): self
    {
        $this->query['username'][] = $username;

        return $this;
    }

    public function addEmail(string $email): self
    {
        $this->query['email'][] = $email;

        return $this;
    }

    /**
     * @return array<string, list<string>|string>
     */
    public function build(Options $options): array
    {
        $result = $this->query;
        $result[$options->isAllowTor() ? 'notorexit' : 'badtorexit'] = '';

        if (null !== $options->getExpire()) {
            $result['expire'] = (string) $options->getExpire();
        }

        $result['json'] = '';
        $result['unix'] = '';

        return $result;
    }
}
