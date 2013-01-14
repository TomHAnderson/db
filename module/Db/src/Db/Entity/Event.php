<?php
namespace Db\Entity;

use Application\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("artist")
 */
class Event extends AbstractEntity
{
    use \Db\Field\Id;
    use \Db\Field\Producer;
    use \Db\Field\City;
    use \Db\Field\Zipcode;
    use \Db\Field\Name;
    use \Db\Field\Note;
    use \Db\Field\Shows;
    use \Db\Field\Links;

    protected $startAt;

    public function getStartAt()
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTime $value)
    {
        $this->startAt = $value;
        return $this;
    }

    protected $endAt;

    public function getEndAt()
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTime $value)
    {
        $this->endAt = $value;
        return $this;
    }

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

