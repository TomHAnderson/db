<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait ShowdateAt
{
    protected $showdateAt;

    public function getShowdateAt()
    {
        return $this->showdateAt;
    }

    public function setShowdateAt(\DateTime $showdateAt) {
        $this->showdateAt = $showdateAt;
        return $this;
    }
}
