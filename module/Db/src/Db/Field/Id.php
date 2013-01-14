<?php

namespace Db\Field;

trait Id
{
    protected $id;

    public function getId()
    {
        return $this->id;
    }
}
