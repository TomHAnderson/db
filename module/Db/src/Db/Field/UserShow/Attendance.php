<?php
namespace Db\Field\UserShow;

use Zend\Form\Annotation as Form;

trait Attendance
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "attendance"})
     * @Form\Options({"label": "Attendance"})
     */
    protected $attendance;

    public function getAttendance()
    {
        return $this->attendance;
    }

    public function setAttendance($value)
    {
        $this->attendance = $value;
        return $this;
    }
}
