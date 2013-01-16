<?php
namespace Db\Field;

use Db\Entity\Show as ShowEntity;

trait Show
{
    protected $show;

    public function getShow() {
        return $this->show;
   }

    public function setShow(ShowEntity $value) {
        $this->show = $value;
        return $this;
    }
}
