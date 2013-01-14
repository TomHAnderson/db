<?php
namespace Db\Entity;

use Application\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Form\Annotation as Form;
use Db\Entity\Artist as ArtistEntity;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("alias")
 */
class Alias extends AbstractEntity {
    use \Db\Field\Id;
    use \Db\Field\Artist;
    use \Db\Field\Name;
    use \Db\Field\NameNormalized;

   /** Hydrator functions */
    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'nameNormalized' => $this->getNameNormalized(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setNameNormalized(isset($data['nameNormalized']) ? $data['nameNormalized']: null);
    }
}
