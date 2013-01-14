<?php

namespace Db\Field;

use Application\Entity\Source as SourceEntity;

trait Source
{
    protected $source;

    public function getSource()
    {
        return $this->source;
    }

    public function setSource(SourceEntity $value)
    {
        $this->source = $value;
        return $this;
    }
}
