<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("song")
 */
class Song extends AbstractEntity {
    use \Db\Field\Id
        , \Db\Field\Name
        , \Db\Field\Composer
        , \Db\Field\Lyrics
        , \Db\Field\Note
        ;

    use \Db\Relation\ShowSongs
        , \Db\Relation\Links
        , \Db\Relation\Composers
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
