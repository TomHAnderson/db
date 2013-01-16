<?php
namespace Db\Field;

use Db\Entity\Band as BandEntity;

trait Band
{
    protected $band;

    public function getBand()
    {
        return $this->band;
    }

    public function setBand(BandEntity $value)
    {
        $this->band = $value;
        return $this;
    }
}
