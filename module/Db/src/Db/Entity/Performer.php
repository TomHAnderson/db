<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form
    , Zend\InputFilter\InputFilter
    ;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("performer")
 */
class Performer extends AbstractEntity {
    use \Db\Entity\Field\Id
        , \Db\Entity\Field\User
        , \Db\Entity\Field\Lastname
        , \Db\Entity\Field\LastnameNormalize
        , \Db\Entity\Field\Firstname
        , \Db\Entity\Field\FirstnameNormalize
        , \Db\Entity\Field\Note
        ;

    use \Db\Entity\Relation\Aliases
        , \Db\Entity\Relation\Lineups
        , \Db\Entity\Relation\Performances
        , \Db\Entity\Relation\Links
        , \Db\Entity\Relation\Comments
        ;

    public function getFullName()
    {
        $fullname = $this->getLastname();
        if ($this->getFirstname()) $fullname .= ', ' . $this->getFirstname();

        return $fullname;
    }

   /** Hydrator functions */
    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'lastname' => $this->getLastname(),
            'lastnameNormalize' => $this->getLastnameNormalize(),
            'firstname' => $this->getFirstname(),
            'firstnameNormalize' => $this->getFirstnameNormalize(),
            'note' => $this->getNote(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setLastname(isset($data['lastname']) ? $data['lastname']: null);
        $this->setFirstname(isset($data['firstname']) ? $data['firstname']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
    }

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add($this->inputFilterInputLastname($inputFilter));
        $inputFilter->add($this->inputFilterInputFirstname($inputFilter));
        $inputFilter->add($this->inputFilterInputNote($inputFilter));

        return $inputFilter;
    }
}
