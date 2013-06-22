<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("attendance")
 */
class Attendance extends AbstractEntity
{
    use Field\Id;
    use Field\Note;

    use Field\User;
    use Field\Performance;

    public function __toString()
    {
        return 'Attended: ' . $this->getPerformance()->getName();
    }

    /** Hydrator functions */
    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'note' => $this->getNote(),
            'user' => $this->getUser(),
            'performance' => $this->getPerformance(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setUser(isset($data['user']) ? $data['user']: null);
        $this->setPerformance(isset($data['performance']) ? $data['performance']: null);
    }
}
