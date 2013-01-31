<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("song")
 */
class Song extends AbstractEntity {
    use \Db\Entity\Field\Id
        , \Db\Entity\Field\Name
        , \Db\Entity\Field\Composer
        , \Db\Entity\Field\Lyrics
        , \Db\Entity\Field\Note
        , \Db\Entity\Field\Band
        ;

    use \Db\Entity\Relation\PerformanceSongs
        , \Db\Entity\Relation\Links
        , \Db\Entity\Relation\Composers
        , \Db\Entity\Relation\Comments
        ;

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'composer' => $this->getComposer(),
            'lyrics' => $this->getLyrics(),
            'note' => $this->getNote(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setComposer(isset($data['composer']) ? $data['composer']: null);
        $this->setLyrics(isset($data['lyrics']) ? $data['lyrics']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
    }
}
