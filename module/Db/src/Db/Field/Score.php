<?php
namespace Db\Field;

use Application\Entity\User as UserEntity;

trait Score
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "score"})
     * @Form\Options({"label": "Score"})
     */
    protected $score;

    public function getScore()
    {
        return $this->score;
    }

    public function setScore($value)
    {
        $this->score = $value;
        return $this;
    }
}
