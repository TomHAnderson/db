<?php

namespace Db\Field\UserShow;
use Zend\Form\Annotation as Form;

trait TradedFrom
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "tradedFrom"})
     * @Form\Options({"label": "Traded From"})
     */
    protected $tradedFrom;

    public function getTradedFrom() {
        return $this->tradedFrom;
    }

    public function setTradedFrom($value) {
        $this->tradedFrom = $value;
        return $this;
    }
}
