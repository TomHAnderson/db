<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form
    , Zend\InputFilter\InputFilter
    , Doctrine\Common\Collections\ArrayCollection
    ;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("pendingQueue")
 */
class PendingQueue extends AbstractEntity {
    use \Db\Entity\Field\Id
        , \Db\Entity\Field\User
        , \Db\Entity\Field\EntityId
        , \Db\Entity\Field\EntityName
        , \Db\Entity\Field\DataType
        , \Db\Entity\Field\Field
        , \Db\Entity\Field\Value
        , \Db\Entity\Field\IsDelete
        , \Db\Entity\Field\CreatedAt
        ;

   /** Hydrator functions */
    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'entityId' => $this->getEntityId(),
            'entityName' => $this->getEntityName(),
            'dataType' => $this->getDataType(),
            'field' => $this->getField(),
            'value' => $this->getValue(),
            'isDelete' => $this->getIsDelete(),
            'createdAt' => $this->getCreatedAt(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['entityId']) ? $data['entityId']: null);
        $this->setName(isset($data['entityName']) ? $data['entityName']: null);
        $this->setName(isset($data['dataType']) ? $data['dataType']: null);
        $this->setName(isset($data['field']) ? $data['field']: null);
        $this->setName(isset($data['value']) ? $data['value']: null);
        $this->setName(isset($data['isDelete']) ? $data['isDelete']: null);
    }

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add($this->inputFilterInputEntityId($inputFilter));
        $inputFilter->add($this->inputFilterInputEntityName($inputFilter));
        $inputFilter->add($this->inputFilterInputDataType($inputFilter));
        $inputFilter->add($this->inputFilterInputField($inputFilter));
        $inputFilter->add($this->inputFilterInputValue($inputFilter));
        $inputFilter->add($this->inputFilterInputIsDelete($inputFilter));

        return $inputFilter;
    }
}
