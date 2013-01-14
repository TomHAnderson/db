<?php

namespace Db\Field;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Artists
{
    protected $artists;

    public function getArtists() {
        if (!$this->artists)
            $this->artists = new ArrayCollection();

        return $this->artists;
    }
}
