<?php
namespace Db\Entity;

use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("link")
 */
final class SongLink extends AbstractLink
{
    use \Db\Field\Song;
}
