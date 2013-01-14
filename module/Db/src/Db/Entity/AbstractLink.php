<?php
namespace Db\Entity;

use Application\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("abstractLink")
 */
class AbstractLink extends AbstractEntity {
    use \Db\Field\Id;
    use \Db\Field\Title;
    use \Db\Field\Url;
    use \Db\Field\Description;
    use \Db\Field\TypeDescriminator;

    /** Hydrator functions */
    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'url' => $this->getUrl(),
            'description' => $this->getDescription(),
            'typeDescriminator' => $this->getTypeDescriminator(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setTitle(isset($data['title']) ? $data['title']: null);
        $this->setUrl(isset($data['url']) ? $data['url']: null);
        $this->setDescription(isset($data['description']) ? $data['description']: null);
    }
}
