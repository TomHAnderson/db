<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Timestamp
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "datetime"})
     * @Form\Attributes({"id": "timestamp"})
     * @Form\Options({"label": "Date Created"})
     */
    protected $timestamp;

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function setTimestamp(\DateTime $value)
    {
        $this->timestamp = $value;
        return $this;
    }
}
