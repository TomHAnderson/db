<?php
namespace Db\Entity;

use Application\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("checksum")
 */
class Checksum extends AbstractEntity
{
    use \Db\Field\Id
        , \Db\Field\Name
        , \Db\Field\Content
        , \Db\Field\Source
        ;

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'content' => $this->getContent(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setContent(isset($data['content']) ? $data['content']: null);
    }
}
