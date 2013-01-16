<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("showSong")
 */
class ShowSong extends AbstractEntity {
    use \Db\Field\Id
        , \Db\Field\Song
        , \Db\Field\Show
        , \Db\Field\Set
        , \Db\Field\Sort
        , \Db\Field\Note
        , \Db\Field\IsSegue
        , \Db\Field\IsEncore
        ;

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'set' => $this->getSet(),
            'sort' => $this->getSort(),
            'note' => $this->getNote(),
            'isSegue' => $this->getIsSegue(),
            'isEncore' => $this->getIsEncore(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setSet(isset($data['set']) ? $data['set']: null);
        $this->setSort(isset($data['sort']) ? $data['sort']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setIsSegue(isset($data['isSegue']) ? $data['isSegue']: null);
        $this->setIsEncore(isset($data['isEncore']) ? $data['isEncore']: null);
    }
}
