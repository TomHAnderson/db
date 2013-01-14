<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("source")
 */
class Source extends AbstractEntity
{
    use \Db\Field\Id
        , \Db\Field\Show
        , \Db\Field\Note
        , \Db\Field\Content
        , \Db\Field\MediaSizeCompressed
        , \Db\Field\MediaSizeUncompressed
        , \Db\Field\DiscCountWav
        , \Db\Field\DiscCountShn
        , \Db\Field\CreatedAt
        , \Db\Field\CirculatedAt
        ;

    use \Db\Relation\Links
        , \Db\Relation\Comments
        , \Db\Relation\UserShows
        , \Db\Relation\WantedBy
        ;

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'showdate' => $this->getShowdate(),
            'showdateAt' => $this->getShowdateAt()->format('r'),
            'set1' => $this->getSet1(),
            'set2' => $this->getSet2(),
            'set3' => $this->getSet3(),
            'note' => $this->getNote(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setShowdate(isset($data['showdate']) ? $data['showdate']: null);
        $this->setShowdateAt(isset($data['showdateAt']) ? $data['showdateAt']: null);
        $this->setSet1(isset($data['set1']) ? $data['set1']: null);
        $this->setSet1(isset($data['set2']) ? $data['set2']: null);
        $this->setSet1(isset($data['set3']) ? $data['set3']: null);
        $this->setSet1(isset($data['note']) ? $data['note']: null);
    }
}

