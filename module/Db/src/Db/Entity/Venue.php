<?php
namespace Db\Entity;

use Application\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("artist")
 */
class Venue extends AbstractEntity
{
    use \Db\Field\Id
        , \Db\Field\City
        , \Db\Field\Zipcode
        , \Db\Field\Name
        , \Db\Field\Note
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
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
    }
}