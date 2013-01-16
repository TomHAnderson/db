<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("show")
 */
class Show extends AbstractEntity
{
    use \Db\Field\Id
        , \Db\Field\Name
        , \Db\Field\NameNormalized        , \Db\Field\Showdate
        , \Db\Field\ShowdateAt
        , \Db\Field\Set1
        , \Db\Field\Set2
        , \Db\Field\Set3
        , \Db\Field\Note
        , \Db\Field\Lineup
        , \Db\Field\Venue
        , \Db\Field\Event
    ;

    use \Db\Relation\Links
        , \Db\Relation\Comments
        , \Db\Relation\Attendees
        , \Db\Relation\UserShows
        , \Db\Relation\WantedBy
        , \Db\Relation\ShowSongs
        , \Db\Relation\Performers
        ;

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'showdate' => $this->getShowdate(),
            'showdateAt' => $this->getShowdateAt()->format('r'),
            'set1' => $this->getSet1(),
            'set2' => $this->getSet2(),
            'set3' => $this->getSet3(),
            'note' => $this->getNote(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setNameNormalized(isset($data['nameNormalized']) ? $data['nameNormalized']: null);
        $this->setShowdate(isset($data['showdate']) ? $data['showdate']: null);
        $this->setShowdateAt(isset($data['showdateAt']) ? $data['showdateAt']: null);
        $this->setSet1(isset($data['set1']) ? $data['set1']: null);
        $this->setSet2(isset($data['set2']) ? $data['set2']: null);
        $this->setSet3(isset($data['set3']) ? $data['set3']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
    }
}

