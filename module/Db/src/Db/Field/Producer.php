<?php
namespace Db\Field;

use Db\Entity\Show as ShowEntity;

trait Producer
{
    protected $producer;

    public function getProducer()
    {
        return $this->producer;
    }

    public function setProducer(ProducerEntity $value)
    {
        $this->producer = $value;
        return $this;
    }
}
