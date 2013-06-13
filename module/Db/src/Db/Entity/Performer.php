<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\InputFilter\InputFilter;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("performer")
 */
class Performer extends AbstractEntity {
    use Field\Id
        , Field\Mbid
        , Field\Name
        , Field\NameNormalize
        , Field\Note

        , Field\User
        ;

    use Relation\Aliases
        , Relation\Lineups
        , Relation\Links
        , Relation\Comments
        , Relation\PerformerLineups
        , Relation\PerformerPerformances
        ;

    public function __toString()
    {
        return $this->getName();
    }

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
        $performances = new ArrayCollection;
        foreach ($this->getPerformerLineups() as $performerLineup) {
            foreach ($performerLineup->getLineup()->getPerformances() as $performance) {
                $performances->add($performance);
            }
        }
        foreach ($this->getPerformerPerformances() as $performerPerformance) {
            $performances->add($performerPerformance->getPerformance());
        }

        return $performances;
    }
}
