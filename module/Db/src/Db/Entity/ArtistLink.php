<?php
namespace Db\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Form\Annotation as Form;
use Application\Entity\Artist as ArtistEntity;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("artistLink")
 */
final class ArtistLink extends AbstractLink
{
    protected $artist;

    public function getArtist()
    {
        return $this->artist;
    }

    public function setArtist(ArtistEntity $value)
    {
        $this->artist = $value;
        return $this;
    }
}
