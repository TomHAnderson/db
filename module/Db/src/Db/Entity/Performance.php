<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form
    , Zend\InputFilter\InputFilter
    ;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("show")
 */
class Performance extends AbstractEntity
{
    use \Db\Entity\Field\Id
        , \Db\Entity\Field\Name
        , \Db\Entity\Field\NameNormalize
        , \Db\Entity\Field\PerformanceDate
        , \Db\Entity\Field\PerformanceDateAt
        , \Db\Entity\Field\Note
        , \Db\Entity\Field\Lineup
        , \Db\Entity\Field\Venue
        , \Db\Entity\Field\Event
        , \Db\Entity\Field\Mbid
    ;

    use \Db\Entity\Relation\Links
        , \Db\Entity\Relation\Comments
        , \Db\Entity\Relation\Attendees
        , \Db\Entity\Relation\UserPerformances
        , \Db\Entity\Relation\WantedBy
        , \Db\Entity\Relation\PerformanceSongs
        , \Db\Entity\Relation\Performers
        , \Db\Entity\Relation\PerformanceSets
        , \Db\Entity\Relation\Sources
        ;

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'mbid' => $this->getMbid(),
            'name' => $this->getName(),
            'performanceDate' => $this->getPerformanceDate(),
            'performanceDateAt' => $this->getPerformanceDateAt()->format('r'),
            'note' => $this->getNote(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setMbid(isset($data['mbid']) ? $data['mbid']: null);
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setNameNormalize(isset($data['nameNormalize']) ? $data['nameNormalize']: null);
        $this->setPerformanceDate(isset($data['performanceDate']) ? $data['performanceDate']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
    }

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add($this->inputFilterInputMbid($inputFilter));
        $inputFilter->add($this->inputFilterInputName($inputFilter));
        $inputFilter->add($this->inputFilterInputPerformanceDate($inputFilter));
        $inputFilter->add($this->inputFilterInputNote($inputFilter));

        return $inputFilter;
    }
}

