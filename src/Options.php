<?php

namespace StopSpam;

class Options
{
    private $allowTor = false;

    /**
     * @return bool
     */
    public function isAllowTor(): bool
    {
        return $this->allowTor;
    }

    /**
     * @param bool $allowTor
     *
     * @return $this
     */
    public function setAllowTor(bool $allowTor): self
    {
        $this->allowTor = $allowTor;

        return $this;
    }
}
