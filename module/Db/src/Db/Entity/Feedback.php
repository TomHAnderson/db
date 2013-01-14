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
    use \Db\Field\Id
        , \Db\Field\From
        , \Db\Field\To
        , \Db\Field\Score
        , \Db\Field\Note
        , \Db\Field\Reply
        , \Db\Field\CreatedAt
        ;

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'note' => $this->getNote(),
            'score' => $this->getScore(),
            'reply' => $this->getReply(),
            'createdAt' => $this->getCreatedAt()->format('r'),
        );
    }

    public function exchangeArray($data)
    {
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setScore(isset($data['score']) ? $data['score']: null);
        $this->setReply(isset($data['reply']) ? $data['reply']: null);
    }
}
