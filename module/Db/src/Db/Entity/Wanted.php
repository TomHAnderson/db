<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;

class Wanted extends AbstractEntity
{
    use Field\Id;
    use Field\User;
    use Field\Performance;
    use Field\Source;

    public function __toString()
    {
        return 'Wanted: ' . (string)$this->getPerformance();
    }
}
