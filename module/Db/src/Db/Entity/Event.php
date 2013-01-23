<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("event")
 */
class Event extends AbstractEntity
{
    use \Db\Entity\Field\Id
        , \Db\Entity\Field\Producer
        , \Db\Entity\Field\Place
        , \Db\Entity\Field\Zipcode
        , \Db\Entity\Field\Name
        , \Db\Entity\Field\Note
        , \Db\Entity\Field\StartAt
        , \Db\Entity\Field\EndAt
        ;

    use \Db\Entity\Relation\Shows
        , \Db\Entity\Relation\Links
        ;

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
        $this->setName(isset($data['note']) ? $data['note']: null);
    }
}

