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
    use Field\Id
        , Field\User
        , Field\Performance
        , Field\Source
        , Field\UserShow\SourceNote
        , Field\UserShow\Checksum
        , Field\CreatedAt
        , Field\UserShow\MediaCount
        , Field\UserShow\MediaType
        , Field\UserShow\NoiseReduction
        , Field\UserShow\ScmsStatus
        , Field\UserShow\ShowRating
        , Field\UserShow\SoundRating
        , Field\UserShow\Microphone
        , Field\UserShow\Generation
        , Field\Note
        , Field\UserShow\JCardComment
        , Field\UserShow\TechNote
        , Field\UserShow\ReferenceNumber
        , Field\UserShow\TradedFrom
        , Field\UserShow\TradedFromEmail
        , Field\UserShow\TradesAllowed
        , Field\Status
        , Field\UserShow\Attendance
        , Field\UserShow\TaperName
        , Field\UserShow\MicLocation
        ;

    use Relation\Lists
        , Relation\Users
        ;

    public function __toString()
    {
        return $this->getUser()->getDisplayName() . ': ' . $this->getPerformance()->getName();
    }

    public function getArrayCopy()
    {
        die('fixme');
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
