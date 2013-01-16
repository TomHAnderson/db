<?php
namespace Db\Field;

use Db\Entity\Composer as ComposerEntity;

trait Composer
{
    protected $composer;

    public function getComposer() {
        return $this->composer;
   }

    public function setComposer(ComposerEntity $value) {
        $this->composer = $value;
        return $this;
    }
}
