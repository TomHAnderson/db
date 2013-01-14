<?php

namespace Db\Field\UserShow;
use Zend\Form\Annotation as Form;

trait TradesAllowed
{
    /**
     * @Form\Type("Zend\Form\Element\Radio")
     * @Form\Attributes({"type": "radio"})
     * @Form\Attributes({"id": "tradesAllowed"})
     * @Form\Attributes({"is_required": true})
     * @Form\Options({"label": "Trades Allowed?", "value_options": {"1": "Yes", "0": "No"}})
     */
    protected $tradesAllowed;

    public function getTradesAllowed()
    {
        return $this->tradesAllowed;
    }

    public function setTradesAllowed($value)
    {
        $this->tradesAllowed = $value;
        return $this;
    }
}
