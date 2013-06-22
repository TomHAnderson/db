<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;
use Zend\InputFilter\InputFilter;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("band-alias")
 */
class BandAlias extends AbstractEntity {
    use Field\Id;
    use Field\Name;
    use Field\NameNormalize;
    use Field\Note;

    use Field\Band;

    public function __toString()
    {
        return $this->getName() . " alias of " . (string)$this->getBand();;
    }

   /** Hydrator functions */
    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'nameNormalized' => $this->getNameNormalize(),
            'note' => $this->getNote(),
            'band' => $this->getBand(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setBand(isset($data['band']) ? $data['band']: null);
    }

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add($this->inputFilterInputName($inputFilter));
        $inputFilter->add($this->inputFilterInputNote($inputFilter));

        return $inputFilter;
    }
}
