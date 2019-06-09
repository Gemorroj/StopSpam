<?php

namespace StopSpam;

class Item
{
    private $data;

    /**
     * Item constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->data['value'];
    }

    /**
     * @return float
     */
    public function getFrequency(): float
    {
        return $this->data['frequency'];
    }

    /**
     * @return bool
     */
    public function isAppears(): bool
    {
        return 1 === $this->data['appears'];
    }
}
