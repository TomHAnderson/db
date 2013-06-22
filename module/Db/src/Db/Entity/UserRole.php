<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;
use Zend\InputFilter\InputFilter;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("userRole")
 */
class UserRole extends AbstractEntity {
    use Field\Id;
    use Field\Name;

    use Relation\Users;

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
