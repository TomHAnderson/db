<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;
use ZfcUser\Entity\UserInterface;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("user")
 */
class User extends AbstractEntity implements UserInterface
{
    use \Db\Field\Id
        , \Db\Field\DisplayName
        , \Db\Field\Username
        , \Db\Field\Email
        , \Db\Field\Password
        , \Db\Field\Note
        , \Db\Field\IsPublic
        , \Db\Field\accessToken
        , \Db\Field\Permission
        , \Db\Field\CreatedAt
        , \Db\Field\LastRequestAt
        , \Db\Field\Subscription
        ;

    use \Db\Relation\Lists
        , \Db\Relation\Groups
        , \Db\Relation\Friends
        , \Db\Relation\ReverseFriends
        , \Db\Relation\Comments
        , \Db\Relation\Attendance
        , \Db\Relation\UserShows
        , \Db\Relation\FeedbackFrom
        , \Db\Relation\FeedbackTo
        , \Db\Relation\WantedBy
        , \Db\Relation\Inbox
        , \Db\Relation\Outbox
        , \Db\Relation\FieldConfig
        ;

    protected $state;

    public function __construct() {
        $this->setCreatedAt(new \DateTime());
        $this->setLastRequestAt(new \DateTime());
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
            'createdAt' => $this->getCreatedAt()->format('r'),
            'lastRequestAt' => $this->getLastRequestAt()->format('r'),
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