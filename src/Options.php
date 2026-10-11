<?php

declare(strict_types=1);

namespace StopSpam;

class Options
{
    /**
     * Allow Tor exit nodes. Maps to the API "notorexit" parameter when true (Tor exits are not treated as
     * listed) and to "badtorexit" when false (any Tor exit is forced to appear as found).
     */
    private bool $allowTor = false;

    /**
     * Maximum age of results in days, sent as the API "expire" parameter. Null omits the parameter and keeps
     * the API default (usernames older than 90 days are hidden, ip/email are not age-filtered).
     */
    private ?int $expire = null;

    public function isAllowTor(): bool
    {
        return $this->allowTor;
    }

    /**
     * @param bool $allowTor true to ignore Tor exit listings, false to treat any Tor exit as found
     */
    public function setAllowTor(bool $allowTor): self
    {
        $this->allowTor = $allowTor;

        return $this;
    }

    public function getExpire(): ?int
    {
        return $this->expire;
    }

    /**
     * @param ?int $expire maximum age in days, or null to use the API default
     */
    public function setExpire(?int $expire): self
    {
        $this->expire = $expire;

        return $this;
    }
}
