<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("artist")
 */
class Artist extends AbstractEntity
{
    use \Db\Field\Id
        , \Db\Field\Name
        , \Db\Field\NameNormalized
        , \Db\Field\Note
        , \Db\Relation\Shows
        , \Db\Relation\Links
        , \Db\Relation\Aliases
        , \Db\Relation\Groups
        ;

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'nameNormalized' => $this->getNameNormalized(),
            'note' => $this->getNote(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setNameNormalized(isset($data['nameNormalized']) ? $data['nameNormalized']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
    }
}
