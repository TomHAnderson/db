<?php

namespace Db\Field;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait LastRequestAt
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "datetime"})
     * @Form\Attributes({"id": "lastRequestAt"})
     * @Form\Options({"label": "Last Request"})
     */
    protected $lastRequestAt;

    public function getLastRequestAt()
    {
        return $this->lastRequestAt;
    }

    public function setLastRequestAt(\DateTime $value)
    {
        $this->lastRequestAt = $value;
        return $this;
    }
}
