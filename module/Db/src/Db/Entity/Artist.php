<?php
namespace Db\Entity;

use Application\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("artist")
 */
class Artist extends AbstractEntity
{
    use \Db\Field\Id;
    use \Db\Field\Name;
    use \Db\Field\NameNormalized;
    use \Db\Field\Note;
    use \Db\Field\Shows;
    use \Db\Field\Links;

    protected $aliases;

    public function getAliases() {
        if (!$this->aliases)
            $this->aliases = new ArrayCollection();

        return $this->aliases;
    }

    protected $groups;

    public function getGroups() {
        if (!$this->groups)
            $this->groups = new ArrayCollection();

        return $this->groups;
    }


    /** Hydrator functions */
    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'nameNormalized' => $this->getNameNormalized(),
            'note' => $this->getNote(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setNameNormalized(isset($data['nameNormalized']) ? $data['nameNormalized']: null);
        $this->setDescription(isset($data['description']) ? $data['description']: null);
    }
}
