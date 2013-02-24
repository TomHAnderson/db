<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait Content
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "textarea"})
     * @Form\Attributes({"id": "content"})
     * @Form\Options({"label": "Content"})
     */
    protected $content;

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($value)
    {
        $this->content = $value;
        return $this;
    }

    private function inputFilterInputContent($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'name' => 'content',
            'required' => true,
            'validators' => array(),
        ));
    }
}
