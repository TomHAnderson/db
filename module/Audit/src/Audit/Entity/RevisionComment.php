<?php
namespace Audit\Entity;

use Zend\Form\Annotation as Form
    , Db\Entity\AbstractComment as AbstractComment
    ;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("comment")
 */
class RevisionComment extends AbstractComment
{
    use \Audit\Entity\Field\Revision;
}
