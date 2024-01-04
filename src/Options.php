<?php

declare(strict_types=1);

namespace StopSpam;

class Options
{
    private bool $allowTor = false;

    public function isAllowTor(): bool
    {
        return $this->allowTor;
    }

    public function setAllowTor(bool $allowTor): self
    {
        $this->allowTor = $allowTor;

        return $this;
    }
}
