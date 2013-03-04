<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait userMeta
{
    protected $userMeta;

    public function getUserMeta() {
        if (!$this->userMeta)
            $this->userMeta = new ArrayCollection();

        return $this->userMeta;
    }
}
