<?php
namespace Db\Field;

use Db\Entity\Performer as PerformerEntity;

trait Performer
{
    protected $performer;

    public function getPerformer()
    {
        return $this->performer;
    }

    public function setPerformer(PerformerEntity $value)
    {
        $this->performer = $value;
        return $this;
    }
}
