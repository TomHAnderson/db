<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;

class Wanted extends AbstractEntity
{
    use \Db\Entity\Field\Id;
    use \Db\Entity\Field\User;
    use \Db\Entity\Field\Performance;
    use \Db\Entity\Field\Source;

    public function __toString()
    {
        return $this->getPerformance()->getName();
    }
}
