<?php
namespace Db\Entity;

use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("venueLink")
 */
final class VenueLink extends AbstractLink
{
    use \Db\Field\Venue;
}
