<?php
namespace Db\Entity;

use Application\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("event")
 */
class Event extends AbstractEntity
{
    use \Db\Field\Id;
        , \Db\Relation\Producer
        , \Db\Field\City
        , \Db\Field\Zipcode
        , \Db\Field\Name
        , \Db\Field\Note
        , \Db\Field\StartAt
        , \Db\Field\EndAt
        ;

    use \Db\Relation\Shows
        , \Db\Relation\Links
        ;

    /** Hydrator functions */
    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'note' => $this->getNote(),
            'startAt' => $this->getStartAt()->format('r'),
            'endAt' => $this->getStartAt()->format('r'),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
    }
}

