<?php
namespace Db\Entity;

use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("comment")
 */
final class PerformanceComment extends AbstractComment
{
    use Field\Performance;
}
