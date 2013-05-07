<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("list")
 */
class UserList extends AbstractEntity
{
    use \Db\Entity\Field\Id
        , \Db\Entity\Field\User
        , \Db\Entity\Field\Name
        , \Db\Entity\Field\Abbrev
        , \Db\Entity\Field\Note
        ;

    use \Db\Entity\Relation\UserPerformances
        , \Db\Entity\Relation\Performances
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
            'abbrev' => $this->getAbbrev(),
            'note' => $this->getNote(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setAbbrev(isset($data['abbrev']) ? $data['abbrev']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
    }
}
