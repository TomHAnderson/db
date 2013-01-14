<?php
namespace Db\Entity;

use Application\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("artist")
 */
class AbstractComment extends AbstractEntity
{
    use \Db\Field\Id;
    use \Db\Field\User;
    use \Db\Field\Note;
    use \Db\Field\CreatedAt;
    use \Db\Field\TypeDescriminator;

    /** Hydrator functions */
    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'note' => $this->getNote(),
            'createdAt' => $this->getCreatedAt()->format('r'),
        );
    }

    public function exchangeArray($data)
    {
        $this->setNote(isset($data['note']) ? $data['note']: null);
    }
}
