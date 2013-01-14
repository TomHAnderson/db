<?php
namespace Db\Entity;

use Application\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("list")
 */
class UserList extends AbstractEntity
{
    use \Db\Field\Id;
    use \Db\Field\User;
    use \Db\Field\Name;
    use \Db\Field\Abbrev;
    use \Db\Field\Note;
    use \Db\Relation\UserShows;

    /** Hydrator functions */
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
