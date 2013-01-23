<?php
namespace Db\Entity\Field;

use Db\Entity\Country as CountryEntity;

trait Country
{
    protected $country;

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry(CountryEntity $value)
    {
        $this->country = $value;
        return $this;
    }
}
