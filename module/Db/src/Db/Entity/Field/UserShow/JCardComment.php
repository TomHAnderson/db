<?php

namespace Db\Entity\Field\UserShow;
use Zend\Form\Annotation as Form;

trait JCardComment
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "textarea"})
     * @Form\Attributes({"id": "jCardComment"})
     * @Form\Options({"label": "J Card Comment"})
     */
    protected $jCardComment;

    public function getJCardComment() {
        return $this->jCardComment;
    }

    public function setJCardComment($value) {
        $this->jCardComment = $value;
        return $this;
    }
}
