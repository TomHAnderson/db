<?php
namespace Db\Entity;

use Application\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("feedback")
 */
class Feedback extends AbstractEntity
{
    use \Db\Field\Id
        , \Db\Field\Score
        , \Db\Field\Note
        , \Db\Field\Reply
        , \Db\Field\CreatedAt
    ;

    use \Db\Relation\From
        , \Db\Relation\To
        ;

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'note' => $this->getNote(),
            'score' => $this->getScore(),
            'reply' => $this->getReply();
            'createdAt' => $this->getCreatedAt()->format('r'),
        );
    }

    public function exchangeArray($data)
    {
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setNote(isset($data['score']) ? $data['score']: null);
    }
}
