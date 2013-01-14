<?php
namespace Db\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Form\Annotation as Form;
use Application\Entity\Producer as ProducerEntity;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("producerLink")
 */
final class ProducerLink extends AbstractLink
{
    protected $producer;

    public function getProducer()
    {
        return $this->producer;
    }

    public function setProducer(ProducerEntity $value)
    {
        $this->producer = $value;
        return $this;
    }
}
