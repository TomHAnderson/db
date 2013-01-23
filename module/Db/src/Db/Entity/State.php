<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("state")
 */
class State extends AbstractEntity
{
    use \Db\Entity\Field\Id
        , \Db\Entity\Field\Country
        , \Db\Entity\Field\Name
        , \Db\Entity\Field\Abbrev
        ;

    use \Db\Entity\Relation\Places
        ;

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'abbrev' => $this->getAbbrev(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setAbbrev(isset($data['abbrev']) ? $data['abbrev']: null);
    }
}


