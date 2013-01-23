<?php
namespace Db\Entity;

use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("link")
 */
final class PerformerLink extends AbstractLink
{
    use \Db\Entity\Field\Performer;
}
