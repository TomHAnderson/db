<?php
namespace Db\Field;

use Application\Entity\Artist as StateEntity;

trait State
{
    protected $state;

    public function getState()
    {
        return $this->state;
    }

    public function setState(StateEntity $value)
    {
        $this->state = $value;
        return $this;
    }
}
