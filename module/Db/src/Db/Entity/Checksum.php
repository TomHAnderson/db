<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;
use Zend\InputFilter\InputFilter;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("checksum")
 */
class Checksum extends AbstractEntity
{
    use Field\Id
        , Field\Name
        , Field\Content
        , Field\Source
        ;

    public function __toString()
    {
        return $this->getName();
    }

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'content' => $this->getContent(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setContent(isset($data['content']) ? $data['content']: null);
    }

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add($this->inputFilterInputName($inputFilter));
        $inputFilter->add($this->inputFilterInputContent($inputFilter));

        return $inputFilter;
    }
}
