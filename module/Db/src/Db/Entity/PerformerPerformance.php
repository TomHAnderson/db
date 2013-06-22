<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;
use Zend\InputFilter\InputFilter;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("performer-performance")
 */
class PerformerPerformance extends AbstractEntity {
    use Field\Id;
    use Field\Note;

    use Field\Performer;
    use Field\Performance;

   /** Hydrator functions */
    public function getArrayCopy()
    {
        return [
            'id' => $this->getId(),
            'note' => $this->getNote(),
            'performer' => $this->getPerformer(),
            'performance' => $this->getPerformance(),
        ];
    }

    public function __toString()
    {
        return (string)$this->getPerformer() . ': ' . (string)$this->getPerformance();
    }

    public function exchangeArray($data)
    {
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setPerformer(isset($data['performer']) ? $data['performer']: null);
        $this->setPerformance(isset($data['performance']) ? $data['performance']: null);
    }

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add($this->inputFilterInputNote($inputFilter));

        return $inputFilter;
    }
}
