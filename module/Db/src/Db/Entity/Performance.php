<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

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
            'name' => $this->getName(),
            'performanceDate' => $this->getPerformanceDate(),
            'performanceDateAt' => $this->getPerformanceDateAt()->format('r'),
            'note' => $this->getNote(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setNameNormalize(isset($data['nameNormalize']) ? $data['nameNormalize']: null);
        $this->setPerformanceDate(isset($data['performanceDate']) ? $data['performanceDate']: null);
        $this->setPerformanceDateAt(isset($data['performanceDateAt']) ? $data['performanceDateAt']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
    }
}

