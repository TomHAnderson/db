<?php
namespace Db\Entity;

use Application\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("artist")
 */
class City extends AbstractEntity
{
    use \Db\Field\Id;
    use \Db\Field\Name;
    use \Db\Field\State;
    use \Db\Field\Venues;
    use \Db\Field\Events;
    use \Db\Field\Zipcodes;

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

