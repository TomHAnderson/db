<?php
namespace Db\Field;

use Application\Entity\User as UserEntity;

trait Status
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "status"})
     * @Form\Options({"label": "Status"})
     */
    protected $status;

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($value)
    {
        $this->status = $value;
        return $this;
    }
}
