<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("country")
 */
class Country extends AbstractEntity
{
    use \Db\Field\Id
        , \Db\Field\Name
        , \Db\Field\Abbrev
        ;

    use \Db\Relation\States
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
