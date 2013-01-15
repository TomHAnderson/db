<?php

namespace Db\Form\Element;
use Zend\Form\Annotation as Form;

trait Submit {
    // This trait should add a submit button to an annotation
    // form. It doesn't work & reflection throws a Segfault 11

    /**
     * @ Form\Type("Zend\Form\Element\Submit")
     * @ Form\Attributes({"value":"Submit"})
     * @ Form\Attributes({"id":"submit"})
     */
}