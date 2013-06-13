<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;
use Zend\InputFilter\InputFilter;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("performance-set-song")
 */
class PerformanceSetSong extends AbstractEntity {
    use Field\Id
        , Field\Song
        , Field\PerformanceSet
        , Field\Note
        , Field\Length
        , Field\IsSegue
        , Field\Sort
        ;

    public function __toString()
    {
        return $this->getSong()->getName();
    }

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'note' => $this->getNote(),
            'length' => $this->getLength(),
            'isSegue' => $this->getIsSegue(),
            'sort' => $this->getSort(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setSort(isset($data['sort']) ? $data['sort']: null);
        $this->setLength(isset($data['length']) ? $data['length']: null);
        $this->setIsSegue(isset($data['isSegue']) ? $data['isSegue']: null);
    }

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add($this->inputFilterInputNote($inputFilter));
        $inputFilter->add($this->inputFilterInputLength($inputFilter));
        $inputFilter->add($this->inputFilterInputIsSegue($inputFilter));
        $inputFilter->add($this->inputFilterInputSort($inputFilter));

        return $inputFilter;
    }
}
