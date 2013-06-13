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
    use Field\Id
        , Field\Note
        , Field\Performer
        , Field\Lineup
        ;

    use Relation\PerformerPerformances
        ;

    public function __toString()
    {
        return (string)$this->getLineup() . ': ' . (string)$this->getPerformer();
    }

   /** Hydrator functions */
    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'note' => $this->getNote(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setNote(isset($data['note']) ? $data['note']: null);
    }

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add($this->inputFilterInputNote($inputFilter));

        return $inputFilter;
    }
}
