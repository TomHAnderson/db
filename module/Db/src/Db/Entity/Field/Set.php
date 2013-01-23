<?php
namespace Db\Entity\Field;

use Db\Entity\Set as SetEntity;

trait Set
{
    protected $set;

    public function getSet()
    {
        return $this->set;
    }

    public function setSet(SetEntity $value)
    {
        $this->set = $value;
        return $this;
    }
}
