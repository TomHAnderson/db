<?php
namespace Db\Entity;

use Application\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Form\Annotation as Form;
use ZfcUser\Entity\UserInterface;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("user")
 */
class User extends AbstractEntity implements UserInterface
{
    use \Db\Field\Id;
    use \Db\Field\DisplayName;
    use \Db\Field\Username;
    use \Db\Field\Email;
    use \Db\Field\Password;
    use \Db\Field\Note;
    use \Db\Field\IsPublic;
    use \Db\Field\accessToken;
    use \Db\Field\Permission;
    use \Db\Field\CreatedAt;
    use \Db\Field\LastRequestAt;
    use \Db\Field\Subscription;

    protected $state;

    /** Hydrator functions */
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
        $this->setPassword(isset($data['password']) ? $data['password']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setIsPublic(isset($data['isPublic']) ? $data['isPublic']: null);
        $this->setAccessToken(isset($data['accessToken']) ? $data['accessToken']: null);
        $this->setPermission(isset($data['permission']) ? $data['permission']: null);
        $this->setCreatedAt(isset($data['createdAt']) ? $data['createdAt']: null);
        $this->setLastRequestAt(isset($data['lastRequestAt']) ? $data['lastRequestAt']: null);
        $this->setSubscription(isset($data['subscription']) ? $data['subscription']: null);
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