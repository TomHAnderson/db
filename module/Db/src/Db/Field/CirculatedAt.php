<?php

namespace Db\Field;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait CirculatedAt
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "datetime"})
     * @Form\Attributes({"id": "circulatedAt"})
     * @Form\Options({"label": "Date Circulated"})
     */
    protected $circulatedAt;

    public function getCirculatedAt()
    {
        return $this->circulatedAt;
    }

    public function setCirculatedAt(\DateTime $value)
    {
        $this->circulatedAt = $value;
        return $this;
    }
}
