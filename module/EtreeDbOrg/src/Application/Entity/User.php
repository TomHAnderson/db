<?php
namespace Application\Entity;

use Application\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Form\Annotation as Form;
use ZfcUser\Entity\UserInterface;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("user")
 */
class User extends AbstractEntity implements UserInterface {
    protected $id;

    protected $state;

    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "username"})
     * @Form\Options({"label": "Username"})
     */
    protected $username;

    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "email"})
     * @Form\Options({"label": "Email"})
     */
    protected $email;

    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "password"})
     * @Form\Attributes({"id": "password"})
     * @Form\Options({"label": "Password"})
     */
    protected $password;

    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "displayName"})
     * @Form\Options({"label": "Display Name"})
     */
    protected $displayName;

    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "accessToken"})
     * @Form\Options({"label": "Singly Access Token"})
     */
    protected $accessToken;

    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "datetime"})
     * @Form\Attributes({"id": "createdAt"})
     * @Form\Options({"label": "Date Created"})
     */
    protected $createdAt;

    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "datetime"})
     * @Form\Attributes({"id": "lastRequestAt"})
     * @Form\Options({"label": "Last Request Date"})
     */
    protected $lastRequestAt;

    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "textarea"})
     * @Form\Attributes({"id": "note"})
     * @Form\Options({"label": "About yourself and your trading rules"})
     */
    protected $note;

    /**
     * @Form\Type("Zend\Form\Element\Radio")
     * @Form\Attributes({"type": "radio"})
     * @Form\Attributes({"id": "isPublic"})
     * @Form\Attributes({"is_required": true})
     * @Form\Options({"label": "Share your fitness information with everyone?", "value_options": {"1": "Yes", "0": "No"}})
     */
    protected $isPublic;

    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "perms"})
     * @Form\Options({"label": "Permissions"})
     */
    protected $perms;

    /** Hydrator functions */
    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'username' => $this->getUsername(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'displayName' => $this->getDisplayName(),
            'accessToken' => $this->getAccessToken(),
            'createdAt' => $this->getCreatedAt()->format('r'),
            'lastRequestAt' => $this->getLastRequestAt()->format('r'),
            'note' => $this->getNote(),
            'isPublic' => $this->getIsPublic(),
            'perms' => $this->getPerms(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setUsername(isset($data['username']) ? $data['username']: null);
        $this->setEmail(isset($data['email']) ? $data['email']: null);
        $this->setPassword(isset($data['password']) ? $data['password']: null);
        $this->setDisplayName(isset($data['displayName']) ? $data['displayName']: null);
        $this->setAccessToken(isset($data['accessToken']) ? $data['accessToken']: null);
        $this->setCreatedAt(isset($data['createdAt']) ? $data['createdAt']: null);
        $this->setLastRequestAt(isset($data['lastRequestAt']) ? $data['lastRequestAt']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setIsPublic(isset($data['isPublic']) ? $data['isPublic']: null);
        $this->setPerms(isset($data['perms']) ? $data['perms']: null);
    }

    public function __construct()
    {
#        $this->teams = new ArrayCollection();
#        $this->memberships = new ArrayCollection();
#        $this->fitness = new ArrayCollection();
#        $this->friends = new ArrayCollection();

        $this->setCreatedAt(new \DateTime());
        $this->setLastRequestAt(new \DateTime());
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        throw new \Exception('Cannot set id');
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($value)
    {
        $this->username = $value;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($value)
    {
        $this->email = $value;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($value)
    {
        $this->password = $value;
        return $this;
    }

    public function getDisplayName()
    {
        return $this->displayName;
    }

    public function setDisplayName($value)
    {
        $this->displayName = $value;
        return $this;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function setAccessToken($value)
    {
        $this->accessToken = $value;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $value)
    {
        $this->createdAt = $value;
        return $this;
    }

    public function getLastRequestAt()
    {
        return $this->lastRequestAt;
    }

    public function setLastRequestAt(\DateTime $value)
    {
        $this->lastRequestAt = $value;
        return $this;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function setNote($value)
    {
        $this->note = $value;
        return $this;
    }

    public function getIsPublic()
    {
        return $this->isPublic;
    }

    public function setIsPublic($value)
    {
        $this->isPublic = $value;
        return $this;
    }

    public function getPerms()
    {
        return $this->perms;
    }

    public function setPerms($value)
    {
        $this->perms = $value;
        return $this;
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
