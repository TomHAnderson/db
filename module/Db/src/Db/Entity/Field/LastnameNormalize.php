<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form
    , Db\Filter\Normalize
;

trait LastnameNormalize
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "lastnameNormalize"})
     * @Form\Options({"label": "Lastname Normalize"})
     */
    protected $lastnameNormalize;

    public function getLastnameNormalize()
    {
        return $this->lastnameNormalize;
    }

    public function setLastnameNormalize($value)
    {
        $filterNormalize = new Normalize();

        $this->lastnameNormalize = $filterNormalize($value);
        return $this;
    }
}
