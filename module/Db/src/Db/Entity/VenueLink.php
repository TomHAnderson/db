<?php
namespace Db\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Form\Annotation as Form;

use Application\Entity\Venue as VenueEntity;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("venueLink")
 */
final class VenueLink extends AbstractLink
{
    protected $venue;

    public function getVenue() {
        return $this->venue;
    }

    public function setVenue(VenueEntity $value) {
        $this->venue = $value;
        return $this;
    }
}
