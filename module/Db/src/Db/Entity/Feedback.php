<?php
namespace Db\Entity;

use Application\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("attendance")
 */
class Feedback extends AbstractEntity
{
    use \Db\Field\Id;
    use \Db\Field\From;
    use \Db\Field\To;
    use \Db\Field\Note;
    use \Db\Field\CreatedAt;
    use \Db\Field\Score;

    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "textarea"})
     * @Form\Attributes({"id": "reply"})
     * @Form\Options({"label": "Reply"})
     */
    protected $reply;

    public function getReply() {
        return $this->reply;
    }

    public function setReply($value) {
        $this->reply = $value;
        return $this;
    }


    /** Hydrator functions */
    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'note' => $this->getNote(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setNote(isset($data['note']) ? $data['note']: null);
    }
}
