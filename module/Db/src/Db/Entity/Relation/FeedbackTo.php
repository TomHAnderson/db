<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait FeedbackTo
{
    protected $feedbackTo;

    public function getFeedbackTo()
    {
        if (!$this->feedbackTo)
            $this->feedbackTo = new ArrayCollection();

        return $this->feedbackTo;
    }
}
