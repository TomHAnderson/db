<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form
    , Zend\InputFilter\InputFilter
    , Doctrine\Common\Collections\ArrayCollection
    ;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("band")
 */
class Band extends AbstractEntity {
    use \Db\Entity\Field\Id
        , \Db\Entity\Field\BandGroup
        , \Db\Entity\Field\Name
        , \Db\Entity\Field\NameNormalize
        , \Db\Entity\Field\Note
        , \Db\Entity\Field\Mbid
        ;

    use \Db\Entity\Relation\Aliases
        , \Db\Entity\Relation\Lineups
        , \Db\Entity\Relation\Links
        , \Db\Entity\Relation\Comments
        , \Db\Entity\Relation\Songs
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
        $this->setMbid(isset($data['mbid']) ? $data['mbid']: null);
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
    }

    public function diff($data)
    {
        $diff = array();
        if ($this->getMbid() != $data['mbid']) {
            $diff['mbid'] = array(
                'value' => $data['mbid'],
                'datatype' => 'integer',
            );
        }

        return $diff;
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
