<?php

namespace Db\Field;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Comments
{
    protected $comments;

    public function getEvents()
    {
        if (!$this->comments)
            $this->comments = new ArrayCollection();

        return $this->comments;
    }
}
