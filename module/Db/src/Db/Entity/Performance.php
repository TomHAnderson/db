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
    use Field\Id;
    use Field\Mbid;
    use Field\Name;
    use Field\NameNormalize;
    use Field\PerformanceDate;
    use Field\PerformanceDateAt;
    use Field\Note;

    use Field\Lineup;
    use Field\Venue;
    use Field\Event;

    use Relation\Links;
    use Relation\Comments;
    use Relation\Attendees;
    use Relation\UserPerformances;
    use Relation\WantedBy;
    use Relation\PerformanceSetSongs;
    use Relation\Performers;
    use Relation\PerformanceSets;
    use Relation\Sources;
    use Relation\PerformerPerformances;

    public function getArrayCopy()
    {
        return [
            'id' => $this->getId(),
            'mbid' => $this->getMbid(),
            'name' => $this->getName(),
            'nameNormalize' => $this->getNameNormalize(),
            'performanceDate' => $this->getPerformanceDate(),
            'performanceDateAt' => $this->getPerformanceDateAt(),
            'note' => $this->getNote(),
            'lineup' => $this->getLineup(),
            'venue' => $this->getVenue(),
            'event' => $this->getEvent(),
        ];
    }

    public function exchangeArray($data)
    {
        $this->setMbid(isset($data['mbid']) ? $data['mbid']: null);
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setPerformanceDate(isset($data['performanceDate']) ? $data['performanceDate']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setLineup(isset($data['lineup']) ? $data['lineup']: null);
        $this->setVenue(isset($data['venue']) ? $data['venue']: null);
        $this->setEvent(isset($data['event']) ? $data['event']: null);
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