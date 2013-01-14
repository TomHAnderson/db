<?php
namespace Db\Entity;

use Zend\Form\Annotation as Form;
use Application\Entity\Show as ShowEntity;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("showLink")
 */
final class ShowLink extends AbstractLink
{
    use \Db\Field\Show;
}
