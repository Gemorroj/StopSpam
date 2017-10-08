<?php
namespace StopSpam;


class Item
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }


    public function getData()
    {
        return $this->getData();
    }

    public function getValue()
    {
        return $this->data['value'];
    }

    public function getFrequency()
    {
        return $this->data['frequency'];
    }

    public function getAppears()
    {
        return 1 === $this->data['appears'];
    }
}
