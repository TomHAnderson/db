<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("mail")
 */
class Mail extends AbstractEntity
{
    use Field\Id
        , Field\From
        , Field\To
        , Field\CreatedAt
        , Field\Note
        , Field\Status
        ;

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'createdAt' => $this->getCreatedAt()->format('r'),
            'note' => $this->getNote(),
            'status' => $this->getStatus(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setStatus(isset($data['status']) ? $data['status']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
    }
}
