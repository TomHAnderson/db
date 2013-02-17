<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form
    , Db\Filter\Normalize
;

trait FirstnameNormalize
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "firstnameNormalize"})
     * @Form\Options({"label": "Firstname Normalize"})
     */
    protected $firstnameNormalize;

    public function getFirstnameNormalize()
    {
        return $this->firstnameNormalize;
    }

    public function setFirstnameNormalize($value)
    {
        $filterNormalize = new Normalize();

        $this->firstnameNormalize = $filterNormalize($value);
        return $this;
    }
}
