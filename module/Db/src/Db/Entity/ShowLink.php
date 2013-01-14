<?php
namespace Db\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Form\Annotation as Form;
use Application\Entity\Show as ShowEntity;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("showLink")
 */
final class ShowLink extends AbstractLink
{
    protected $show;

    public function getShow() {
        return $this->show;
   }

    public function setShow(ShowEntity $value) {
        $this->show = $value;
        return $this;
    }
}
