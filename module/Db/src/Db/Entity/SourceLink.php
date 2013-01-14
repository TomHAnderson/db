<?php
namespace Db\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Form\Annotation as Form;

use Application\Entity\Source as SourceEntity;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("sourceLink")
 */
final class SourceLink extends AbstractLink
{
    protected $source;

    public function getSource()
    {
        return $this->source;
    }

    public function setSource(SourceEntity $value)
    {
        $this->source = $value;
        return $this;
    }
}
