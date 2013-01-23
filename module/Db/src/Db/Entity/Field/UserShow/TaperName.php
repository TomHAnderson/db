<?php
namespace Db\Entity\Field\UserShow;

use Zend\Form\Annotation as Form;

trait TaperName
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "taperName"})
     * @Form\Options({"label": "Taper Name"})
     */
    protected $taperName;

    public function getTaperName()
    {
        return $this->taperName;
    }

    public function setTaperName($value)
    {
        $this->taperName = $value;
        return $this;
    }
}
