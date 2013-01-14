<?php
namespace Db\Entity;

use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("sourceLink")
 */
final class SourceLink extends AbstractLink
{
    use \Db\Field\Source;
}
