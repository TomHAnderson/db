<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("band")
 */
class Band extends AbstractEntity {
    use \Db\Field\Id
        , \Db\Field\BandGroup
        , \Db\Field\Name
        , \Db\Field\NameNormalized
        , \Db\Field\Note
        ;

    use \Db\Relation\Aliases
        , \Db\Relation\Lineups
        , \Db\Relation\Links
        ;

   /** Hydrator functions */
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
