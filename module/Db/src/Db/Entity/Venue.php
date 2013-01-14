<?php
namespace Db\Entity;

use Application\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("artist")
 */
class Venue extends AbstractEntity
{
    use \Db\Field\Id;
    use \Db\Field\City;
    use \Db\Field\Zipcode;
    use \Db\Field\Name;
    use \Db\Field\Note;

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

