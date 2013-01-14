<?php

namespace Db\Field;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Reply
{
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
}
