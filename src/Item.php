<?php

namespace StopSpam;

class Item
{
    private $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getValue(): string
    {
        return $this->data['value'];
    }

    public function getFrequency(): float
    {
        return $this->data['frequency'];
    }

    public function isAppears(): bool
    {
        return 1 === $this->data['appears'];
    }
}
