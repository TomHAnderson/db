<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form
    , Zend\InputFilter\InputFilter
    ;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("performer")
 */
class Performer extends AbstractEntity {
    use \Db\Entity\Field\Id
        , \Db\Entity\Field\Mbid
        , \Db\Entity\Field\User
        , \Db\Entity\Field\Name
        , \Db\Entity\Field\NameNormalize
        , \Db\Entity\Field\Note
        ;

    use \Db\Entity\Relation\Aliases
        , \Db\Entity\Relation\Lineups
        , \Db\Entity\Relation\Links
        , \Db\Entity\Relation\Comments
        , \Db\Entity\Relation\PerformerLineups
        , \Db\Entity\Relation\PerformerPerformances
        ;

   /** Hydrator functions */
    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'mbid' => $this->getMbid(),
            'name' => $this->getName(),
            'nameNormalize' => $this->getNameNormalize(),
            'note' => $this->getNote(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setMbid(isset($data['mbid']) ? $data['mbid']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
    }

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add($this->inputFilterInputName($inputFilter));
        $inputFilter->add($this->inputFilterInputMbid($inputFilter));
        $inputFilter->add($this->inputFilterInputNote($inputFilter));

        return $inputFilter;
    }

    public function getPerformances()
    {
        $performances = array();
        foreach ($this->getPerformerLineups() as $lineup) {
            $performances += getPerformances();
        }
        foreach ($this->getPerformerPerformances() as $performerPerformance) {
            $performances[] = $performerPerformance->getPerformance();
        }


        return $performances;
    }
}
