<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("userShow")
 */
class UserPerformance extends AbstractEntity
{
    use \Db\Entity\Field\Id
        , \Db\Entity\Field\User
        , \Db\Entity\Field\Performance
        , \Db\Entity\Field\Source
        , \Db\Entity\Field\UserShow\SourceNote
        , \Db\Entity\Field\UserShow\Checksum
        , \Db\Entity\Field\CreatedAt
        , \Db\Entity\Field\UserShow\MediaCount
        , \Db\Entity\Field\UserShow\MediaType
        , \Db\Entity\Field\UserShow\NoiseReduction
        , \Db\Entity\Field\UserShow\ScmsStatus
        , \Db\Entity\Field\UserShow\ShowRating
        , \Db\Entity\Field\UserShow\SoundRating
        , \Db\Entity\Field\UserShow\Microphone
        , \Db\Entity\Field\UserShow\Generation
        , \Db\Entity\Field\Note
        , \Db\Entity\Field\UserShow\JCardComment
        , \Db\Entity\Field\UserShow\TechNote
        , \Db\Entity\Field\UserShow\ReferenceNumber
        , \Db\Entity\Field\UserShow\TradedFrom
        , \Db\Entity\Field\UserShow\TradedFromEmail
        , \Db\Entity\Field\UserShow\TradesAllowed
        , \Db\Entity\Field\Status
        , \Db\Entity\Field\UserShow\Attendance
        , \Db\Entity\Field\UserShow\TaperName
        , \Db\Entity\Field\UserShow\MicLocation
        ;

    use \Db\Entity\Relation\Lists
        , \Db\Entity\Relation\Users
        ;

    public function __toString()
    {
        return $this->getUser()->getDisplayName() . ': ' . $this->getPerformance()->getName();
    }

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'abbrev' => $this->getAbbrev(),
            'note' => $this->getNote(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setAbbrev(isset($data['abbrev']) ? $data['abbrev']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
    }
}
