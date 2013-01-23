<?php

namespace Geoname\Entity\Field;

trait Tld
{
    protected $tld;

    public function setTld($tld)
    {
        $this->tld = $tld;
        return $this;
    }

    public function getTld()
    {
        return $this->tld;
    }
}