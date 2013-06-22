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
    use Field\Id;
    use Field\DisplayName;
    use Field\Username;
    use Field\Email;
    use Field\Password;
    use Field\Note;
    use Field\IsPublic;
    use Field\AccessToken;
    use Field\Permission;
    use Field\CreatedAt;
    use Field\Subscription;

    // 1:1
    use Field\Performer;

    use Relation\Lists;
    use Relation\Groups;
    use Relation\Friends;
    use Relation\ReverseFriends;
    use Relation\Comments;
    use Relation\Attendance;
    use Relation\UserPerformances;
    use Relation\FeedbackFrom;
    use Relation\FeedbackTo;
    use Relation\WantedBy;
    use Relation\Inbox;
    use Relation\Outbox;
    use Relation\FieldConfig;
    use Relation\BandGroups;
    use Relation\UserMeta;
    use Relation\UserRoles;

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
        return [
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
#            'performer' => $this->getPerformer(),
        ];
    }

    public function exchangeArray($data)
    {
        $this->setDisplayName(isset($data['displayName']) ? $data['displayName']: null);
        $this->setUsername(isset($data['username']) ? $data['username']: null);
        $this->setEmail(isset($data['email']) ? $data['email']: null);
        $this->setPassword(isset($data['password']) ? $data['password']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setIsPublic(isset($data['isPublic']) ? $data['isPublic']: null);
        $this->setAccessToken(isset($data['accessToken']) ? $data['accessToken']: null);
        $this->setPermission(isset($data['permission']) ? $data['permission']: null);
        $this->setCreatedAT(isset($data['createdAt']) ? $data['createdAt']: null);
        $this->setSubscription(isset($data['subscription']) ? $data['subscription']: null);
#        $this->setPerformer(isset($data['performer']) ? $data['performer']: null);
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
