<?php
namespace Db\Entity;

use Application\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("userShowField")
 */
class UserShowField extends AbstractEntity
{
    use \Db\Field\Id
        , \Db\Field\Name
        , \Db\Relation\Users
        ;

    /** Hydrator functions */
    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
    }
}
