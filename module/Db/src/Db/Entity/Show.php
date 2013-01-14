<?php
namespace Db\Entity;

use Application\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("show")
 */
class Show extends AbstractEntity
{
    use \Db\Field\Id;
    use \Db\Field\Name;
    use \Db\Field\Note;

    use \Db\Field\Artist;
    use \Db\Field\Venue;
    use \Db\Field\Event;
    use \Db\Field\Links;

    protected $showdate;

    public function getShowdate()
    {
        return $this->showdate;
    }

    public function setShowdate($showdate) {
        $this->showdate = $showdate;
        return $this;
    }

    protected $showdateAt;

    public function getShowdateAt()
    {
        return $this->showdateAt;
    }

    public function setShowdateAt(\DateTime $showdateAt) {
        $this->showdateAt = $showdateAt;
        return $this;
    }

    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "textarea"})
     * @Form\Attributes({"id": "set1"})
     * @Form\Options({"label": "Set 1"})
     */
    protected $set1;

    public function getSet1() {
        return $this->set1;
    }

    public function setSet1($value) {
        $this->set1 = $value;
        return $this;
    }

    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "textarea"})
     * @Form\Attributes({"id": "set2"})
     * @Form\Options({"label": "Set 2"})
     */
    protected $set2;

    public function getSet2() {
        return $this->set2;
    }

    public function setSet2($value) {
        $this->set2 = $value;
        return $this;
    }

    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "textarea"})
     * @Form\Attributes({"id": "set3"})
     * @Form\Options({"label": "Set 3"})
     */
    protected $set3;

    public function getSet3() {
        return $this->set3;
    }

    public function setSet3($value) {
        $this->set3 = $value;
        return $this;
    }



    /** Hydrator functions */
    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'nameNormalized' => $this->getNameNormalized(),
            'note' => $this->getNote(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setNameNormalized(isset($data['nameNormalized']) ? $data['nameNormalized']: null);
        $this->setDescription(isset($data['description']) ? $data['description']: null);
    }
}
