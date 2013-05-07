<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form
    , Zend\InputFilter\InputFilter
    , Doctrine\Common\Collections\ArrayCollection
    ;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("userRole")
 */
class UserRole extends AbstractEntity {
    use \Db\Entity\Field\Id
        , \Db\Entity\Field\Name
        ;

    use \Db\Entity\Relation\Users
        ;

    public function __toString()
    {
        return $this->getName();
    }

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

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add($this->inputFilterInputName($inputFilter));

        return $inputFilter;
    }
}
