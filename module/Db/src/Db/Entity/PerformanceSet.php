<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;
use Zend\InputFilter\InputFilter;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("performance-set")
 */
class PerformanceSet extends AbstractEntity
{
    use Field\Id;
    use Field\Name;
    use Field\Note;
    use Field\Sort;

    use Field\Performance;

    use Relation\PerformanceSetSongs;

    public function __toString()
    {
        return $this->getName();
    }

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'note' => $this->getNote(),
            'sort' => $this->getSort(),
            'performance' => $this->getPerformance(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setSort(isset($data['sort']) ? $data['sort']: 9999);
        $this->setPerformance(isset($data['performance']) ? $data['performance']: null);
    }

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add($this->inputFilterInputName($inputFilter));
        $inputFilter->add($this->inputFilterInputNote($inputFilter));
        $inputFilter->add($this->inputFilterInputSort($inputFilter));

        return $inputFilter;
    }
}

