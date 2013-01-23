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
    use \Db\Entity\Field\Id
        , \Db\Entity\Field\Name
        , \Db\Entity\Field\NameNormalize
        , \Db\Entity\Field\Showdate
        , \Db\Entity\Field\ShowdateAt
        , \Db\Entity\Field\Set1
        , \Db\Entity\Field\Set2
        , \Db\Entity\Field\Set3
        , \Db\Entity\Field\Note
        , \Db\Entity\Field\Lineup
        , \Db\Entity\Field\Venue
        , \Db\Entity\Field\Event
    ;

    use \Db\Entity\Relation\Links
        , \Db\Entity\Relation\Comments
        , \Db\Entity\Relation\Attendees
        , \Db\Entity\Relation\UserShows
        , \Db\Entity\Relation\WantedBy
        , \Db\Entity\Relation\ShowSongs
        , \Db\Entity\Relation\Performers
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
        $this->setNameNormalize(isset($data['nameNormalize']) ? $data['nameNormalize']: null);
        $this->setShowdate(isset($data['showdate']) ? $data['showdate']: null);
        $this->setShowdateAt(isset($data['showdateAt']) ? $data['showdateAt']: null);
        $this->setSet1(isset($data['set1']) ? $data['set1']: null);
        $this->setSet2(isset($data['set2']) ? $data['set2']: null);
        $this->setSet3(isset($data['set3']) ? $data['set3']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
    }
}

