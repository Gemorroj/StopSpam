<?php

declare(strict_types=1);

namespace StopSpam;

class Query
{
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
