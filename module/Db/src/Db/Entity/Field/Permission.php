<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait Permission
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "permission"})
     * @Form\Options({"label": "Permission"})
     */
    protected $permission;

    public function getPermission()
    {
        return $this->permission;
    }

    public function setPermission($value)
    {
        $this->permission = $value;
        return $this;
    }
}
