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
    use Field\Id;
    use Field\CreatedAt;
    use Field\Note;
    use Field\Status;

    use Field\From;
    use Field\To;

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'createdAt' => $this->getCreatedAt(),
            'note' => $this->getNote(),
            'status' => $this->getStatus(),
            'from' => $this->getFrom(),
            'to' => $this->getTo(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setStatus(isset($data['status']) ? $data['status']: null);
        $this->setFrom(isset($data['from']) ? $data['from']: null);
        $this->setTo(isset($data['to']) ? $data['to']: null);
    }
}
