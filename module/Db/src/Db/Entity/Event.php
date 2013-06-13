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
    use Field\Id
        , Field\Producer
        , Field\Zipcode
        , Field\Name
        , Field\NameNormalize
        , Field\Note
        , Field\StartAt
        , Field\EndAt
        ;

    use Relation\Performances
        , Relation\Links
        , Relation\Comments
        ;

    public function __toString()
    {
        return $this->getName();
    }

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'nameNormalize' => $this->getNameNormalize(),
            'note' => $this->getNote(),
            'zipcode' => $this->getZipcode(),
            'startAt' => $this->getStartAt()->format('r'),
            'endAt' => $this->getStartAt()->format('r'),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setName(isset($data['note']) ? $data['note']: null);
        $this->setStartAt(isset($data['startAt']) ? $data['startAt']: null);
        $this->setEndAt(isset($data['endAt']) ? $data['endAt']: null);
        $this->setZipcode(isset($data['zipcode']) ? $data['zipcode']: null);
    }
}

