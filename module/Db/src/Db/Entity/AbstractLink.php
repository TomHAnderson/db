<?php
namespace Db\Entity;

use Application\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("abstractLink")
 */
class AbstractLink extends AbstractEntity {
    protected $id;

    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "title"})
     * @Form\Options({"label": "Title"})
     */
    protected $title;

    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "url"})
     * @Form\Options({"label": "URL"})
     */
    protected $url;

    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "textarea"})
     * @Form\Attributes({"id": "description"})
     * @Form\Options({"label": "Description"})
     */
    protected $description;

    protected $typeDescriminator;

    /** Hydrator functions */
    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'url' => $this->getUrl(),
            'description' => $this->getDescription(),
            'typeDescriminator' => $this->getTypeDescriminator(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setTitle(isset($data['title']) ? $data['title']: null);
        $this->setUrl(isset($data['url']) ? $data['url']: null);
        $this->setDescription(isset($data['description']) ? $data['description']: null);
    }

    public function __construct()
    {
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($value) {
        $this->title = $value;
        return $this;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($value) {
        $this->url = $value;
        return $this;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($value) {
        $this->description = $value;
        return $this;
    }

    public function getTypeDescriminator() {
        return $this->typeDescriminator;
    }

    public function setTypeDescriminator($value) {
        $this->typeDescriminator = $value;
        return $this;
    }
}
