<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait Password
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "password"})
     * @Form\Attributes({"id": "password"})
     * @Form\Options({"label": "Password"})
     */
    protected $password;

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($value)
    {
        $this->password = $value;
        return $this;
    }
}
