<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;
use Zend\InputFilter\InputFilter;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("venue")
 */
class Venue extends AbstractEntity
{
    use Field\Id;
    use Field\Name;
    use Field\NameNormalize;
    use Field\City;
    use Field\State;
    use Field\Country;
    use Field\Zipcode;
    use Field\Note;

    use Relation\Performances;
    use Relation\Links;
    use Relation\Comments;
    use Relation\VenueGroups;

    public function __toString()
    {
        return $this->getName();
    }

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'nameNormalize' => $this->getNameNormalize(),
            'city' => $this->getCity(),
            'state' => $this->getState(),
            'country' => $this->getCountry(),
            'zipcode' => $this->getZipcode(),
            'note' => $this->getNote(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setCity(isset($data['city']) ? $data['city']: null);
        $this->setState(isset($data['state']) ? $data['state']: null);
        $this->setCountry(isset($data['country']) ? $data['country']: null);
        $this->setZipcode(isset($data['zipcode']) ? $data['zipcode']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
    }

    public function getInputFilter() {
        $inputFilter = new InputFilter();

        $inputFilter->add($this->inputFilterInputName($inputFilter));
        $inputFilter->add($this->inputFilterInputCity($inputFilter));
        $inputFilter->add($this->inputFilterInputState($inputFilter));
        $inputFilter->add($this->inputFilterInputCountry($inputFilter));
        $inputFilter->add($this->inputFilterInputZipcode($inputFilter));
        $inputFilter->add($this->inputFilterInputNote($inputFilter));

        return $inputFilter;
    }
}
