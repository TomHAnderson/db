<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("feedback")
 */
class Feedback extends AbstractEntity
{
    use Field\Id;
    use Field\Score;
    use Field\Note;
    use Field\Reply;
    use Field\CreatedAt;

    use Field\From;
    use Field\To;

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'score' => $this->getScore(),
            'note' => $this->getNote(),
            'reply' => $this->getReply(),
            'createdAt' => $this->getCreatedAt(),
            'from' => $this->getFrom(),
            'to' => $this->getTo(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setScore(isset($data['score']) ? $data['score']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setReply(isset($data['reply']) ? $data['reply']: null);
        $this->setFrom(isset($data['from']) ? $data['from']: null);
        $this->setTo(isset($data['to']) ? $data['to']: null);
    }
}
