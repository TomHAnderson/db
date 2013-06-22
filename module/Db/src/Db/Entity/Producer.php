<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("producer")
 */
class Producer extends AbstractEntity
{
    use Field\Id;
    use Field\Name;
    use Field\NameNormalize;
    use Field\Note;

    use Relation\Events;
    use Relation\Links;

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
            'note' => $this->getNote(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
    }
}
