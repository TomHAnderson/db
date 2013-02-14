<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Comments
{
    protected $comments;

    public function getComments()
    {
        if (!$this->comments)
            $this->comments = new ArrayCollection();

        return $this->comments;
    }
}
