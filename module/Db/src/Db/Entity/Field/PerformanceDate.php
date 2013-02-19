<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait PerformanceDate
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "performanceDate"})
     * @Form\Options({"label": "Performance Date"})
     * @Form\Attributes({"pattern": "[0-9\?]{4}-[0-9\?]{2}-[0-9\?]{2}"})
     * @Form\Attributes({"data-validation-pattern-message": "Invalid date format"})
     * @Form\Attributes({"placeholder": "yyyy-mm-dd, ? if unknown"})
     */
    protected $performanceDate;

    public function getPerformanceDate()
    {
        return $this->performanceDate;
    }

    public function setPerformanceDate($performanceDate) {
        $this->performanceDate = $performanceDate;

        $year = strtok($performanceDate, '-');
        $month = strtok('-');
        $day = strtok('-');

        if (strstr('?', $year)) {
            $year = 1939;
        } else {
            $year = (int)$year;
        }

        if (strstr('?', $month)) {
            $month = 9;
        } else {
            $month = (int)$month;
        }

        if (strstr('?', $day)) {
            $day = 1;
        } else {
            $day = (int)$day;
        }

        $this->setPerformanceDateAt(\DateTime::createFromFormat('Y-m-d', "$year-$month-$day"));
        return $this;
    }

    private function inputFilterInputPerformanceDate($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'name' => 'performanceDate',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'date',
                ),
            ),
        ));
    }
}
