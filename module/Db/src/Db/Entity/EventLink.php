<?php
namespace Db\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Form\Annotation as Form;
use Application\Entity\Event as EventEntity;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("eventLink")
 */
final class EventLink extends AbstractLink
{
    protected $event;

    public function getEvent()
    {
        return $this->event;
    }

    public function setEvent(EventEntity $value)
    {
        $this->event = $value;
        return $this;
    }
}
