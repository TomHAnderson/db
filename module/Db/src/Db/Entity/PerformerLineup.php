<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form
    , Zend\InputFilter\InputFilter
    ;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("performer-lineup")
 */
class PerformerLineup extends AbstractEntity {
    use \Db\Entity\Field\Id
        , \Db\Entity\Field\Note
        , \Db\Entity\Field\Performer
        , \Db\Entity\Field\Lineup
        ;

    use \Db\Entity\Relation\PerformerPerformances
        ;

    public function __toString()
    {
        return $this->getLineup()->getName() . ': ' . $this->getPerformer()->getName();
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
