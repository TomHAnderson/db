<?php

namespace Db\Field\UserShow;
use Zend\Form\Annotation as Form;

trait TradedFromEmail
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "tradedFromEmail"})
     * @Form\Options({"label": "Traded From Email"})
     */
    protected $tradedFromEmail;

    public function getTradedFromEmail() {
        return $this->tradedFromEmail;
    }

    public function setTradedFromEmail($value) {
        $this->tradedFromEmail = $value;
        return $this;
    }
}
