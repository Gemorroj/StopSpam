<?php
namespace StopSpam;

class Options
{
    private $scheme = 'http';
    private $allowTor = false;

    /**
     * @return bool
     */
    public function isAllowTor()
    {
        return $this->allowTor;
    }

    /**
     * @param bool $allowTor
     * @return $this
     */
    public function setAllowTor($allowTor)
    {
        $this->allowTor = $allowTor;
        return $this;
    }

    /**
     * @return string
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * @param string $scheme
     * @return $this
     */
    public function setScheme($scheme)
    {
        if (!\in_array($scheme, ['http', 'https'], true)) {
            throw new \InvalidArgumentException('Unsupported scheme. Support only "http" and "https" schemes.');
        }
        $this->scheme = $scheme;
        return $this;
    }
}
