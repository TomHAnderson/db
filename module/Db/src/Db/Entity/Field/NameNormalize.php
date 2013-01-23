<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form
    , Db\Filter\Normalize
;

trait NameNormalize
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "nameNormalize"})
     * @Form\Options({"label": "Name Normalize"})
     */
    protected $nameNormalize;

    public function getNameNormalize()
    {
        return $this->nameNormalize;
    }

    public function setNameNormalize($value)
    {
        $filterNormalize = new Normalize();

        $this->nameNormalize = $filterNormalize($value);
        return $this;
    }
}
