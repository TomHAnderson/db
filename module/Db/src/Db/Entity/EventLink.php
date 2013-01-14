<?php
namespace Db\Entity;

use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("eventLink")
 */
final class EventLink extends AbstractLink
{
    use \Db\Field\Event;
}
