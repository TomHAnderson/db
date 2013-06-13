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
    use Field\Id
        , Field\From
        , Field\To
        , Field\Score
        , Field\Note
        , Field\Reply
        , Field\CreatedAt
        ;

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'score' => $this->getScore(),
            'note' => $this->getNote(),
            'reply' => $this->getReply(),
            'createdAt' => $this->getCreatedAt()->format('r'),
        );
    }

    public function exchangeArray($data)
    {
        $this->setScore(isset($data['score']) ? $data['score']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setReply(isset($data['reply']) ? $data['reply']: null);
    }
}
