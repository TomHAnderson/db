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
    use Field\Id;
    use Field\User;
    use Field\Performance;
    use Field\Source;
    use Field\UserShow\SourceNote;
    use Field\UserShow\Checksum;
    use Field\CreatedAt;
    use Field\UserShow\MediaCount;
    use Field\UserShow\MediaType;
    use Field\UserShow\NoiseReduction;
    use Field\UserShow\ScmsStatus;
    use Field\UserShow\ShowRating;
    use Field\UserShow\SoundRating;
    use Field\UserShow\Microphone;
    use Field\UserShow\Generation;
    use Field\Note;
    use Field\UserShow\JCardComment;
    use Field\UserShow\TechNote;
    use Field\UserShow\ReferenceNumber;
    use Field\UserShow\TradedFrom;
    use Field\UserShow\TradedFromEmail;
    use Field\UserShow\TradesAllowed;
    use Field\Status;
    use Field\UserShow\Attendance;
    use Field\UserShow\TaperName;
    use Field\UserShow\MicLocation;

    use Relation\Lists;
    use Relation\Users;

    public function __toString()
    {
        return $this->getUser()->getDisplayName() . ': ' . $this->getPerformance()->getName();
    }

    public function getArrayCopy()
    {
        die('fixme: implement user performance collecting');
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
