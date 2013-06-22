<?php

namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;
use Zend\InputFilter\InputFilter;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("band")
 */
class Band extends AbstractEntity
{
    use Field\Id;
    use Field\Name;
    use Field\NameNormalize;
    use Field\Note;
    use Field\Mbid;

    use Field\BandGroup;

    use Relation\Aliases;
    use Relation\Lineups;
    use Relation\Links;
    use Relation\Comments;
    use Relation\Songs;

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
            'bandGroup' => $this->getBandGroup(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setMbid(isset($data['mbid']) ? $data['mbid']: null);
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setNote(isset($data['bandGroup']) ? $data['bandGroup']: null);
    }

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add($this->inputFilterInputMbid($inputFilter));
        $inputFilter->add($this->inputFilterInputName($inputFilter));
        $inputFilter->add($this->inputFilterInputNote($inputFilter));

        return $inputFilter;
    }

    public function getPerformances() {
        $return = new ArrayCollection();

        // fixme add sort
        foreach ($this->getLineups() as $lineup) {
            foreach ($lineup->getPerformances() as $performance) {
                $return->add($performance);
            }
        }

        return $return;
    }
}
