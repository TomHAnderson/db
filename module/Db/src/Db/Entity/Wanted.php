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

    public function getArrayCopy()
    {
        return [
            'user' => $this->getUser(),
            'performance' => $this->getPerformance(),
            'source' => $this->getSource(),
        ];
    }

    public function exchangeArray($data)
    {
        $this->setUser(isset($data['user']) ? $data['user']: null);
        $this->setPerformance(isset($data['performance']) ? $data['performance']: null);
        $this->setSource(isset($data['source']) ? $data['source']: null);
    }

}
