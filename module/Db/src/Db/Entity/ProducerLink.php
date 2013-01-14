<?php
namespace Db\Entity;

use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("producerLink")
 */
final class ProducerLink extends AbstractLink
{
    use \Db\Field\Producer;
}
