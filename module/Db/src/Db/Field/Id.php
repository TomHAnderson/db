<?php

namespace Db\Field;

trait Id
{
    protected $id;

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        throw new \Exception('Cannot set id');
    }
}
