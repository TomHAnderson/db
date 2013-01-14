<?php
namespace Db\Field;

use Application\Entity\Country as CountryEntity;

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
