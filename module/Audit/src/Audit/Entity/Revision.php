<?php
namespace Audit\Entity;

use Zend\Form\Annotation as Form
    , Db\Entity\AbstractEntity
    ;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("revision")
 */
final class Revision extends AbstractEntity
{
    use \Db\Entity\Field\Id
        , \Db\Entity\Field\User
        , \Db\Entity\Field\Timestamp
        ;

    use \Db\Entity\Relation\Comments;
}
