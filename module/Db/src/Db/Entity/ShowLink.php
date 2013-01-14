<?php
namespace Db\Entity;

use Zend\Form\Annotation as Form;
use Application\Entity\Show as ShowEntity;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("link")
 */
final class ShowLink extends AbstractLink
{
    use \Db\Field\Show;
}
