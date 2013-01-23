<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("alias")
 */
class Alias extends AbstractEntity {
    use \Db\Entity\Field\Id
        , \Db\Entity\Field\Band
        , \Db\Entity\Field\Name
        , \Db\Entity\Field\NameNormalize
        ;

   /** Hydrator functions */
    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'nameNormalized' => $this->getNameNormalize(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setNameNormalized(isset($data['nameNormalize']) ? $data['nameNormalize']: null);
    }
}
