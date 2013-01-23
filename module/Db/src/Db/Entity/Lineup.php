<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("lineup")
 */
class Lineup extends AbstractEntity {
    use \Db\Entity\Field\Id
        , \Db\Entity\Field\Band
        , \Db\Entity\Field\Name
        , \Db\Entity\Field\Note
        ;

    use \Db\Entity\Relation\Shows
        , \Db\Entity\Relation\Performers
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
