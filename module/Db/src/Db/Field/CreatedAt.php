<?php

namespace Db\Field;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait CreatedAt
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "datetime"})
     * @Form\Attributes({"id": "createdAt"})
     * @Form\Options({"label": "Date Created"})
     */
    protected $createdAt;

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $value)
    {
        $this->createdAt = $value;
        return $this;
    }
}
