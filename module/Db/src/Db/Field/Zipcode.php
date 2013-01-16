<?php
namespace Db\Field;

use Application\Entity\Zipcode as ZipcodeEntity;

trait Zipcode
{
    protected $zipcode;

    public function getZipcode()
    {
        return $this->zipcode;
    }

    public function setZipcode(ZipcodeEntity $value)
    {
        $this->zipcode = $value;
        return $this;
    }
}
