<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("userList")
 */
class UserList extends AbstractEntity
{
    use Field\Id;
    use Field\Name;
    use Field\Abbrev;
    use Field\Note;

    use Field\User;

    use Relation\UserPerformances;
    use Relation\Performances;

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
            'user' => $this->getUser(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setAbbrev(isset($data['abbrev']) ? $data['abbrev']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setUser(isset($data['user']) ? $data['user']: null);
    }
}
