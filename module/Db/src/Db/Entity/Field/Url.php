<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait Url
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "url"})
     * @Form\Options({"label": "URL"})
     */
    protected $url;

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($value) {
        $this->url = $value;
        return $this;
    }

    private function inputFilterInputUrl($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'name' => 'url',
            'required' => true  ,
            'validators' => array(
                array(
                    'name' => 'uri'
                ),
            ),
        ));
    }
}
