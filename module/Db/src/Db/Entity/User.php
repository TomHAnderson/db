<?php

namespace Db\Entity;
use Db\Entity\AbstractEntity
    , Zend\Form\Annotation as Form
    , ZfcUser\Entity\UserInterface
    , Zend\InputFilter\InputFilter
    ;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("user")
 */
class User extends AbstractEntity implements UserInterface
{
    use \Db\Entity\Field\Id
        , \Db\Entity\Field\DisplayName
        , \Db\Entity\Field\Username
        , \Db\Entity\Field\Email
        , \Db\Entity\Field\Password
        , \Db\Entity\Field\Note
        , \Db\Entity\Field\IsPublic
        , \Db\Entity\Field\AccessToken
        , \Db\Entity\Field\Permission
        , \Db\Entity\Field\CreatedAt
        , \Db\Entity\Field\Subscription
        , \Db\Entity\Field\Performer
        ;

    use \Db\Entity\Relation\Lists
        , \Db\Entity\Relation\Groups
        , \Db\Entity\Relation\Friends
        , \Db\Entity\Relation\ReverseFriends
        , \Db\Entity\Relation\Comments
        , \Db\Entity\Relation\Attendance
        , \Db\Entity\Relation\UserPerformances
        , \Db\Entity\Relation\FeedbackFrom
        , \Db\Entity\Relation\FeedbackTo
        , \Db\Entity\Relation\WantedBy
        , \Db\Entity\Relation\Inbox
        , \Db\Entity\Relation\Outbox
        , \Db\Entity\Relation\FieldConfig
        , \Db\Entity\Relation\BandGroups
        , \Db\Entity\Relation\Revisions
        , \Db\Entity\Relation\UserMeta
        , \Db\Entity\Relation\UserRoles
        , \Db\Entity\Relation\PendingQueue
        ;

    // State is a ZfcUser field, not geographic information
    protected $state;

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
