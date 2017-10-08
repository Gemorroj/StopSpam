<?php
namespace StopSpam;


class Item
{
    private $data = [];

    /**
     * Item constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->data['value'];
    }

    /**
     * @return float
     */
    public function getFrequency()
    {
        return $this->data['frequency'];
    }

    /**
     * @return bool
     */
    public function getAppears()
    {
        return 1 === $this->data['appears'];
    }
}
