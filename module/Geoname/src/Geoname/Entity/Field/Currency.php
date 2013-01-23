<?php

namespace Geoname\Entity\Field;
use Geoname\Entity\Currency as CurrencyEntity;

trait Currency
{
    protected $currency;

    public function setCurrency(CurrencyEntity $currency)
    {
        $this->currency = $currency;
        return $this;
    }

    public function getCurrency()
    {
        return $this->currency;
    }
}