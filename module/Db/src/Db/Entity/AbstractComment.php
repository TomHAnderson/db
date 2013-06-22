<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("abstractComment")
 */
class AbstractComment extends AbstractEntity
{
    use Field\Id;
    use Field\Note;
    use Field\Rating;
    use Field\CreatedAt;
    use Field\TypeDescriminator;

    use Field\User;

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'note' => $this->getNote(),
            'rating' => $this->getRating(),
            'createdAt' => $this->getCreatedAt(),
            'user' => $this->getUser(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setRating(isset($data['rating']) ? $data['rating']: null);
        $this->setUser(isset($data['user']) ? $data['user']: null);
    }
}
