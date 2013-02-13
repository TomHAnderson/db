<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form
    , Zend\InputFilter\InputFilter
    ;

trait Note
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "textarea"})
     * @Form\Attributes({"id": "note"})
     * @Form\Options({"label": "Note"})
     */
    protected $note;

    public function getNote()
    {
        return $this->note;
    }

    public function setNote($value)
    {
        $this->note = $value;
        return $this;
    }

    private function inputFilterInputNote(InputFilter $inputFilter)
    {
        return $inputFilter->getFactory()->createInput(array(
            'name' => 'note',
            'required' => false,
            'validators' => array(),
        ));
    }
}
