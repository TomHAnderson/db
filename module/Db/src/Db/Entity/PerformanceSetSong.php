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
    use Field\Id;
    use Field\Note;
    use Field\Length;
    use Field\IsSegue;
    use Field\Sort;

    use Field\Song;
    use Field\PerformanceSet;

    public function __toString()
    {
        return $this->getSong()->getName();
    }

    public function getArrayCopy()
    {
        return [
            'id' => $this->getId(),
            'note' => $this->getNote(),
            'length' => $this->getLength(),
            'isSegue' => $this->getIsSegue(),
            'sort' => $this->getSort(),
            'song' => $this->getSong(),
            'performanceSet' => $this->getPerformanceSet(),
        ];
    }

    public function exchangeArray($data)
    {
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setLength(isset($data['length']) ? $data['length']: null);
        $this->setIsSegue(isset($data['isSegue']) ? $data['isSegue']: null);
        $this->setSort(isset($data['sort']) ? $data['sort']: null);
        $this->setSong(isset($data['song']) ? $data['song']: null);
        $this->setPerformanceSet(isset($data['performanceSet']) ? $data['performanceSet']: null);
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
