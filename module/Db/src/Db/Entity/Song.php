<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form
    , Zend\InputFilter\InputFilter
    , Doctrine\Common\Collections\ArrayCollection
    ;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("song")
 */
class Song extends AbstractEntity {
    use \Db\Entity\Field\Id
        , \Db\Entity\Field\Name
        , \Db\Entity\Field\NameNormalize
        , \Db\Entity\Field\Lyrics
        , \Db\Entity\Field\Note
        , \Db\Entity\Field\Band
        , \Db\Entity\Field\Mbid
        ;

    use \Db\Entity\Relation\PerformanceSetSongs
        , \Db\Entity\Relation\Links
        , \Db\Entity\Relation\Comments
        ;

    public function __toString()
    {
        return $this->getName();
    }

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'mbid' => $this->getMbid(),
            'name' => $this->getName(),
            'nameNormalize' => $this->getNameNormalize(),
            'lyrics' => $this->getLyrics(),
            'note' => $this->getNote(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setMbid(isset($data['mbid']) ? $data['mbid']: null);
        $this->setName(isset($data['name']) ? $data['name']: null);
        $this->setLyrics(isset($data['lyrics']) ? $data['lyrics']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
    }

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add($this->inputFilterInputMbid($inputFilter));
        $inputFilter->add($this->inputFilterInputName($inputFilter));
        $inputFilter->add($this->inputFilterInputNote($inputFilter));

        return $inputFilter;
    }

    public function getPerformances() {

        $return = new ArrayCollection();
        foreach ($this->getPerformanceSetSongs() as $performanceSetSong) {
            $return->add($performanceSetSong->getPerformanceSet()->getPerformance());
        }

        return $return;
    }
}
