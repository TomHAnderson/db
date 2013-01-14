<?php
namespace Db\Entity;

use Application\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("abstractComment")
 */
class AbstractComment extends AbstractEntity
{
    use \Db\Field\Id
        , \Db\Field\User
        , \Db\Field\Note
        , \Db\Field\CreatedAt
        , \Db\Field\TypeDescriminator
        ;

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
