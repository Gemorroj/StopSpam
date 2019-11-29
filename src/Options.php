<?php

namespace StopSpam;

class Options
{
    private $allowTor = false;

    public function isAllowTor(): bool
    {
        return $this->allowTor;
    }

    /**
     * @return $this
     */
    public function setAllowTor(bool $allowTor): self
    {
        $this->allowTor = $allowTor;

        return $this;
    }
}
