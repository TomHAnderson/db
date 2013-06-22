<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;
use Zend\InputFilter\InputFilter;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("performer-lineup")
 */
class PerformerLineup extends AbstractEntity {
    use Field\Id;
    use Field\Note;

    use Field\Performer;
    use Field\Lineup;

    use Relation\PerformerPerformances;

    public function __toString()
    {
        return (string)$this->getLineup() . ': ' . (string)$this->getPerformer();
    }

   /** Hydrator functions */
    public function getArrayCopy()
    {
        return [
            'id' => $this->getId(),
            'note' => $this->getNote(),
            'performer' => $this->getPerformer(),
            'lineup' => $this->getLineup(),
        ];
    }

    public function exchangeArray($data)
    {
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setPerformer(isset($data['performer']) ? $data['performer']: null);
        $this->setLineup(isset($data['lineup']) ? $data['lineup']: null);
    }

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add($this->inputFilterInputNote($inputFilter));

        return $inputFilter;
    }
}
