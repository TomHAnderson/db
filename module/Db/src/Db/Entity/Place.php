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
    use \Db\Field\Id
        , \Db\Field\Name
        , \Db\Field\State
        ;

    use \Db\Relation\Venues
        , \Db\Relation\Events
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

