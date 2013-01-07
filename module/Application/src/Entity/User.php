<?php
namespace Application\Entity;

use Loser\Entity\AbstractEntity;
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
     * @Form\Attributes({"id": "username"})
     * @Form\Options({"label": "Username"})
     */
    protected $username;

    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "displayName"})
     * @Form\Options({"label": "Display Name"})
     */
    protected $displayName;

    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "date"})
     * @Form\Attributes({"id": "birthDateAt"})
     * @Form\Options({"label": "Birth Date"})
     */
    protected $birthDateAt;

    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "intger"})
     * @Form\Attributes({"id": "height"})
     * @Form\Options({"label": "Height (inches)"})
     */
    protected $height;

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
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "subscription"})
     * @Form\Options({"label": "Subscription"})
     */
    protected $subscription;

    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "textarea"})
     * @Form\Attributes({"id": "comment"})
     * @Form\Options({"label": "Describe your fitness goals"})
     */
    protected $comment;

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
     * @Form\Attributes({"type": "datetime"})
     * @Form\Attributes({"id": "fitbitLastUpdate"})
     * @Form\Options({"label": "Last Fitbit Update"})
     */
    protected $fitbitLastUpdate;

    protected $fitbitId;

    protected $state;

    /** Hydrator functions */
    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'displayName' => $this->getDisplayName(),
            'accessToken' => $this->getAccessToken(),
            'createdAt' => $this->getCreatedAt()->format('r'),
            'lastRequestAt' => $this->getLastRequestAt()->format('r'),
            'subscription' => $this->getSubscription(),
            'comment' => $this->getComment(),
            'isPublic' => $this->getIsPublic(),
            'height' => $this->getHeight(),
            'birthDateAt' => ($this->getBirthDateAt()) ? $this->getBirthDateAt()->format('Y-m-d'): '',
        );
    }

    public function exchangeArray($data)
    {
        $this->setEmail(isset($data['email']) ? $data['email']: null);
        $this->setPassword(isset($data['password']) ? $data['password']: null);
        $this->setDisplayName(isset($data['displayName']) ? $data['displayName']: null);
        $this->setAccessToken(isset($data['accessToken']) ? $data['accessToken']: null);
        $this->setCreatedAt(isset($data['createdAt']) ? $data['createdAt']: null);
        $this->setLastRequestAt(isset($data['lastRequestAt']) ? $data['lastRequestAt']: null);
        $this->setSubscription(isset($data['subscription']) ? $data['subscription']: null);
        $this->setComment(isset($data['comment']) ? $data['comment']: null);
        $this->setIsPublic(isset($data['isPublic']) ? $data['isPublic']: null);
        $this->setHeight(isset($data['height']) ? $data['height']: null);
        $this->setBirthDateAt(isset($data['birthDateAt']) ? $data['birthDateAt']: null);
    }

    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->memberships = new ArrayCollection();
        $this->fitness = new ArrayCollection();
        $this->friends = new ArrayCollection();
        $this->setBirthDateAt(new \DateTime());
        $this->setCreatedAt(new \DateTime());
        $this->setLastRequestAt(new \DateTime());
        $this->setFitbitLastUpdate(new \DateTime());
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        throw new \Exception('Cannot set id');
    }

    public function getTeams()
    {
        return $this->teams;
    }

    public function getMemberships()
    {
        return $this->memberships;
    }

    public function getFitness()
    {
        return $this->fitness;
    }

    public function getFriends()
    {
        return $this->friends;
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

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($value)
    {
        $this->username = $value;
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

    public function getBirthDateAt()
    {
        return $this->birthDateAt;
    }

    public function setBirthDateAt(\DateTime $value)
    {
        $this->birthDateAt = $value;
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

    public function getSubscription()
    {
        return $this->subscription;
    }

    public function setSubscription($subscription)
    {
        $this->subscription = $subscription;
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

    public function getFitbitId()
    {
        return $this->fitbitId;
    }

    public function setFitbitId($value)
    {
        $this->fitbitId = $value;
        return $this;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($value)
    {
        $this->comment = $value;
        return $this;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($value)
    {
        $this->height = $value;
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

    public function getFitbitLastUpdate()
    {
        return $this->fitbitLastUpdate;
    }

    public function setFitbitLastUpdate(\DateTime $value)
    {
        $this->fitbitLastUpdate = $value;
        return $this;
    }

}
