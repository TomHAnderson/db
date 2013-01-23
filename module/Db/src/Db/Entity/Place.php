<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("place")
 */
class Place extends AbstractEntity
{
    use \Db\Entity\Field\Id
        , \Db\Entity\Field\Name
        , \Db\Entity\Field\State
        ;

    use \Db\Entity\Relation\Venues
        , \Db\Entity\Relation\Events
        ;

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
    }
}

