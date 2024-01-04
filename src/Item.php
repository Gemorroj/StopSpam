<?php

declare(strict_types=1);

namespace StopSpam;

class Item
{
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

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
}
