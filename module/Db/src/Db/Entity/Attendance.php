<?php
namespace Db\Entity;

use Application\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("attendance")
 */
class Attendance extends AbstractEntity
{
    use \Db\Field\Id
        , \Db\Field\User
        , \Db\Field\Show
        , \Db\Field\Note
        ;

    /** Hydrator functions */
    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'note' => $this->getNote(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setNote(isset($data['note']) ? $data['note']: null);
    }
}
