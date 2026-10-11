<?php

declare(strict_types=1);

namespace StopSpam;

class Item
{
    private array $data;

    /**
     * @param array<string, mixed> $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * @return array<string, mixed>
     */
    public function getData(): array
    {
        return $this->data;
    }

    public function getValue(): ?string
    {
        return $this->data['value'] ?? null;
    }

    public function getFrequency(): ?float
    {
        return $this->data['frequency'] ?? null;
    }

    public function isError(): bool
    {
        return isset($this->data['error']);
    }

    public function getError(): ?string
    {
        return $this->data['error'] ?? null;
    }

    public function isAppears(): bool
    {
        return 1 === ($this->data['appears'] ?? null);
    }

    public function getConfidence(): ?float
    {
        return $this->data['confidence'] ?? null;
    }

    public function getLastSeen(): ?int
    {
        return $this->data['lastseen'] ?? null;
    }

    public function isTorExit(): bool
    {
        return 1 === ($this->data['torexit'] ?? null);
    }

    public function getNormalized(): ?string
    {
        return $this->data['normalized'] ?? null;
    }

    public function getCountry(): ?string
    {
        return $this->data['country'] ?? null;
    }

    public function getAsn(): ?int
    {
        return $this->data['asn'] ?? null;
    }

    public function getDelegated(): ?string
    {
        return $this->data['delegated'] ?? null;
    }
}
