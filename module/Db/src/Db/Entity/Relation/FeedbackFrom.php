<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait FeedbackFrom
{
    protected $feedbackFrom;

    public function getFeedbackFrom()
    {
        if (!$this->feedbackFrom)
            $this->feedbackFrom = new ArrayCollection();

        return $this->feedbackFrom;
    }
}
