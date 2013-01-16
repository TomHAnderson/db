<?php
namespace Db\Entity;

use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("link")
 */
final class ComposerLink extends AbstractLink
{
    use \Db\Field\Composer;
}
