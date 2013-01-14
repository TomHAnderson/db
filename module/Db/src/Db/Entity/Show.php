<?php
namespace Db\Entity;

use Application\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("show")
 */
class Show extends AbstractEntity
{
    use \Db\Field\Id;
    use \Db\Field\Name;
    use \Db\Field\Showdate;
    use \Db\Field\ShowdateAt;
    use \Db\Field\Set1;
    use \Db\Field\Set2;
    use \Db\Field\Set3;
    use \Db\Field\Note;
    use \Db\Field\Artist;
    use \Db\Field\Venue;
    use \Db\Field\Event;
    use \Db\Relation\Links;
    use \Db\Relation\Comments;
    use \Db\Relation\Attendees;
    use \Db\Relation\UserShows;
    use \Db\Relation\WantedBy;

    /** Hydrator functions */
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
        $this->setShowdate(isset($data['showdate']) ? $data['showdate']: null);
        $this->setShowdateAt(isset($data['showdateAt']) ? $data['showdateAt']: null);
        $this->setSet1(isset($data['set1']) ? $data['set1']: null);
        $this->setSet1(isset($data['set2']) ? $data['set2']: null);
        $this->setSet1(isset($data['set3']) ? $data['set3']: null);
        $this->setSet1(isset($data['note']) ? $data['note']: null);
    }
}

