<?php

namespace Db\Field;
use Zend\Form\Annotation as Form;

trait Showdate
{
    protected $showdate;

    public function getShowdate()
    {
        return $this->showdate;
    }

    public function setShowdate($showdate) {
        $this->showdate = $showdate;
        return $this;
    }
}
