<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;
use Zend\InputFilter\InputFilter;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("performance")
 */
class Performance extends AbstractEntity
{
    use Field\Id
        , Field\Mbid
        , Field\Name
        , Field\NameNormalize
        , Field\PerformanceDate
        , Field\PerformanceDateAt
        , Field\Note

        , Field\Lineup
        , Field\Venue
        , Field\Event
        ;

    use Relation\Links
        , Relation\Comments
        , Relation\Attendees
        , Relation\UserPerformances
        , Relation\WantedBy
        , Relation\PerformanceSetSongs
        , Relation\Performers
        , Relation\PerformanceSets
        , Relation\Sources
        , Relation\PerformerPerformances
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
        $this->setPerformanceDate(isset($data['performanceDate']) ? $data['performanceDate']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
    }

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add($this->inputFilterInputMbid($inputFilter));
        $inputFilter->add($this->inputFilterInputPerformanceDate($inputFilter));
        $inputFilter->add($this->inputFilterInputNote($inputFilter));

        // Override name; not required
        $inputFilter->add($inputFilter->getFactory()->createInput(array(
            'name' => 'name',
            'required' => false,
            'validators' => array(),
        )));


        return $inputFilter;
    }
}