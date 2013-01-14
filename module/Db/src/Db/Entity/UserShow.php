<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("userShow")
 */
class UserShow extends AbstractEntity
{
    use \Db\Field\Id
        , \Db\Field\User
        , \Db\Field\Show
        , \Db\Field\Source
        , \Db\Field\UserShow\SourceNote
        , \Db\Field\UserShow\Checksum
        , \Db\Field\CreatedAt
        , \Db\Field\UserShow\MediaCount
        , \Db\Field\UserShow\MediaType
        , \Db\Field\UserShow\NoiseReduction
        , \Db\Field\UserShow\ScmsStatus
        , \Db\Field\UserShow\ShowRating
        , \Db\Field\UserShow\SoundRating
        , \Db\Field\UserShow\Microphone
        , \Db\Field\UserShow\Generation
        , \Db\Field\Note
        , \Db\Field\UserShow\JCardComment
        , \Db\Field\UserShow\TechNote
        , \Db\Field\UserShow\ReferenceNumber
        , \Db\Field\UserShow\TradedFrom
        , \Db\Field\UserShow\TradedFromEmail
        , \Db\Field\UserShow\TradesAllowed
        , \Db\Field\Status
        , \Db\Field\UserShow\Attendance
        , \Db\Field\UserShow\TaperName
        , \Db\Field\UserShow\MicLocation
        ;

    use \Db\Relation\Lists
        , \Db\Relation\Users
        ;

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
