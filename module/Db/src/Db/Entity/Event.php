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
    use Field\Id;
    use Field\Name;
    use Field\NameNormalize;
    use Field\Note;
    use Field\StartAt;
    use Field\EndAt;
    use Field\Zipcode;

    use Field\Producer;

    use Relation\Performances;
    use Relation\Links;
    use Relation\Comments;

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
            'startAt' => $this->getStartAt(),
            'endAt' => $this->getStartAt(),
            'zipcode' => $this->getZipcode(),
            'producer' => $this->getProducer(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setStartAt(isset($data['startAt']) ? $data['startAt']: null);
        $this->setEndAt(isset($data['endAt']) ? $data['endAt']: null);
        $this->setZipcode(isset($data['zipcode']) ? $data['zipcode']: null);
        $this->setProducer(isset($data['producer']) ? $data['producer']: null);
    }
}

