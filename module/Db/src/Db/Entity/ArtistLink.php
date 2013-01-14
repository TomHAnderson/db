<?php
namespace Db\Entity;

use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("artistLink")
 */
final class ArtistLink extends AbstractLink
{
    use \Db\Field\Artist;
}
