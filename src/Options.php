<?php

declare(strict_types=1);

namespace StopSpam;

class Options
{
    /**
     * Allow Tor exit nodes: true sends "notorexit", false sends "badtorexit".
     */
    private bool $allowTor = true;

    /**
     * Maximum age of results in days ("expire" parameter); null uses the API default.
     */
    private ?int $expire = null;

    public function isAllowTor(): bool
    {
        return $this->allowTor;
    }

    public function setAllowTor(bool $allowTor): self
    {
        $this->allowTor = $allowTor;

        return $this;
    }

    public function getExpire(): ?int
    {
        return $this->expire;
    }

    public function setExpire(?int $expire): self
    {
        $this->expire = $expire;

        return $this;
    }
}
