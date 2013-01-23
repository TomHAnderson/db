<?php
namespace Db\Entity\Field\UserShow;

use Zend\Form\Annotation as Form;

trait MicLocation
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "micLocation"})
     * @Form\Options({"label": "Mic Location"})
     */
    protected $micLocation;

    public function getMicLocation()
    {
        return $this->micLocation;
    }

    public function setMicLocation($value)
    {
        $this->micLocation = $value;
        return $this;
    }
}
