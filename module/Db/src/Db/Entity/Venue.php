<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("venue")
 */
class Venue extends AbstractEntity
{
    use \Db\Field\Id
        , \Db\Field\Place
        , \Db\Field\Zipcode
        , \Db\Field\Name
        , \Db\Field\Note
        ;

    use \Db\Relation\Shows
        , \Db\Relation\Links
        , \Db\Relation\VenueGroups
        ;

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'note' => $this->getNote(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
    }
}
