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
    use \Db\Entity\Field\Id
        , \Db\Entity\Field\Show
        , \Db\Entity\Field\Note
        , \Db\Entity\Field\Content
        , \Db\Entity\Field\MediaSizeCompressed
        , \Db\Entity\Field\MediaSizeUncompressed
        , \Db\Entity\Field\DiscCountWav
        , \Db\Entity\Field\DiscCountShn
        , \Db\Entity\Field\CreatedAt
        , \Db\Entity\Field\CirculatedAt
        ;

    use \Db\Entity\Relation\Links
        , \Db\Entity\Relation\Comments
        , \Db\Entity\Relation\UserShows
        , \Db\Entity\Relation\WantedBy
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

