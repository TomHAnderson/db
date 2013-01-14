<?php

namespace Db\Field;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Shows
{
    protected $shows;

    public function getShows() {
        if (!$this->shows)
            $this->shows = new ArrayCollection();

        return $this->shows;
    }
}
