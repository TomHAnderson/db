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
        , \Db\Entity\Field\NameNormalize
        , \Db\Entity\Field\Composer
        , \Db\Entity\Field\Lyrics
        , \Db\Entity\Field\Note
        , \Db\Entity\Field\Band
        , \Db\Entity\Field\Mbid
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
            'mbid' => $this->getMbid(),
            'name' => $this->getName(),
            'nameNormalize' => $this->getNameNormalize(),
            'composer' => $this->getComposer(),
            'lyrics' => $this->getLyrics(),
            'note' => $this->getNote(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setMbid(isset($data['mbid']) ? $data['mbid']: null);
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setComposer(isset($data['composer']) ? $data['composer']: null);
        $this->setLyrics(isset($data['lyrics']) ? $data['lyrics']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
    }

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add($this->inputFilterInputMbid($inputFilter));
        $inputFilter->add($this->inputFilterInputName($inputFilter));
        $inputFilter->add($this->inputFilterInputComposer($inputFilter));
        $inputFilter->add($this->inputFilterInputNote($inputFilter));

        return $inputFilter;
    }
}
