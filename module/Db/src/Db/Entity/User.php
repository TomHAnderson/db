<?php

namespace Db\Entity;
use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;
use ZfcUser\Entity\UserInterface;
use Zend\InputFilter\InputFilter;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("user")
 */
class User extends AbstractEntity implements UserInterface
{
    use Field\Id
        , Field\DisplayName
        , Field\Username
        , Field\Email
        , Field\Password
        , Field\Note
        , Field\IsPublic
        , Field\AccessToken
        , Field\Permission
        , Field\CreatedAt
        , Field\Subscription
        , Field\Performer
        ;

    use Relation\Lists
        , Relation\Groups
        , Relation\Friends
        , Relation\ReverseFriends
        , Relation\Comments
        , Relation\Attendance
        , Relation\UserPerformances
        , Relation\FeedbackFrom
        , Relation\FeedbackTo
        , Relation\WantedBy
        , Relation\Inbox
        , Relation\Outbox
        , Relation\FieldConfig
        , Relation\BandGroups
        , Relation\Revisions
        , Relation\UserMeta
        , Relation\UserRoles
        , Relation\PendingQueue
        ;

    // State is a ZfcUser field, not geographic information
    protected $state;

    public function __toString()
    {
        return $this->getDisplayName();
    }

    public function __construct() {
        $this->setCreatedAt(new \DateTime());
        $this->setIsPublic(1);
    }

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'displayName' => $this->getDisplayName(),
            'username' => $this->getUsername(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'note' => $this->getNote(),
            'isPublic' => $this->getIsPublic(),
            'accessToken' => $this->getAccessToken(),
            'permission' => $this->getPermission(),
            'createdAt' => $this->getCreatedAt(),
            'subscription' => $this->getSubscription(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setDisplayName(isset($data['displayName']) ? $data['displayName']: null);
        $this->setUsername(isset($data['username']) ? $data['username']: null);
        $this->setEmail(isset($data['email']) ? $data['email']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setIsPublic(isset($data['isPublic']) ? $data['isPublic']: null);
    }

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add($this->inputFilterInputDisplayName($inputFilter));
        $inputFilter->add($this->inputFilterInputUsername($inputFilter));
        $inputFilter->add($this->inputFilterInputEmail($inputFilter));
        $inputFilter->add($this->inputFilterInputNote($inputFilter));
        $inputFilter->add($this->inputFilterInputIsPublic($inputFilter));

        return $inputFilter;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($value)
    {
        $this->state = $value;
        return $this;
    }
}
