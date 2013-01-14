<?php

namespace Db\Field\UserShow;
use Zend\Form\Annotation as Form;

trait SoundRating
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "soundRating"})
     * @Form\Options({"label": "Sound Rating"})
     */
    protected $soundRating;

    public function getSoundRating() {
        return $this->soundRating;
    }

    public function setSoundRating($value) {
        $this->soundRating = $value;
        return $this;
    }
}
