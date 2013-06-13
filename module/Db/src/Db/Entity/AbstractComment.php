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
    use Field\Id
        , Field\User
        , Field\Note
        , Field\Rating
        , Field\CreatedAt
        , Field\TypeDescriminator
        ;

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'note' => $this->getNote(),
            'rating' => $this->getRating(),
            'createdAt' => $this->getCreatedAt()->format('r'),
        );
    }

    public function exchangeArray($data)
    {
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setNote(isset($data['rating']) ? $data['rating']: null);
    }
}
